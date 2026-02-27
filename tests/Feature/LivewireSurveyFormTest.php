<?php

namespace Tests\Feature;

use App\Livewire\SurveyForm;
use App\Models\Survey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireSurveyFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_the_survey_form()
    {
        $this->get(route('surveys.index'))
            ->assertStatus(200)
            ->assertSeeLivewire(SurveyForm::class);
    }

    /** @test */
    public function it_can_complete_survey_for_diagnosed_user()
    {
        Livewire::test(SurveyForm::class)
            ->set('consent', true)
            ->call('nextStep')
            ->assertSet('currentStep', 2)
            ->set('mail', 'diagnostico@test.com')
            ->set('has_diabetes', '1')
            ->call('nextStep')
            ->assertSet('currentStep', 99)
            ->call('save')
            ->assertRedirect();

        $this->assertDatabaseHas('surveys', [
            'mail' => 'diagnostico@test.com',
            'has_diabetes' => true,
            'risk_level' => 'Diagnosticado con Diabetes',
        ]);
    }

    /** @test */
    public function it_can_complete_survey_for_findrisc_user()
    {
        Livewire::test(SurveyForm::class)
            ->set('consent', true)
            ->call('nextStep')
            ->set('mail', 'findrisc@test.com')
            ->set('has_diabetes', '0')
            ->call('nextStep')
            ->assertSet('currentStep', 3)
            ->set('gender', 'M')
            ->set('age', 50)
            ->set('weight', 85)
            ->set('height', 170)
            ->set('waist', 100)
            ->call('nextStep')
            ->assertSet('currentStep', 4)
            ->set('daily_activity', 2) // no
            ->set('fruit_consumption', 1) // no
            ->set('antihypertensive_medication', 2) // si
            ->set('elevated_glucose', 5) // si
            ->set('family_history', 5) // si grado 1
            ->call('save')
            ->assertRedirect();

        $this->assertDatabaseHas('surveys', [
            'mail' => 'findrisc@test.com',
            'has_diabetes' => false,
            'age' => 50,
        ]);

        $survey = Survey::where('mail', 'findrisc@test.com')->first();
        $this->assertNotNull($survey->score);
        $this->assertNotNull($survey->risk_level);
    }
}
