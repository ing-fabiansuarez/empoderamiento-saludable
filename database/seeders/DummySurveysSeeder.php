<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummySurveysSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Juan', 'Maria', 'Carlos', 'Ana', 'Luis', 'Pedro', 'Laura', 'Sofia', 'Jorge', 'Marta', 'Camila', 'Andres', 'Valentina', 'Mateo', 'Lucia'];
        $surnames = ['Perez', 'Gomez', 'Lopez', 'Diaz', 'Martinez', 'Rodriguez', 'Fernandez', 'Garcia', 'Sanchez', 'Romero', 'Torres', 'Ramirez', 'Ruiz', 'Flores'];

        for ($i = 0; $i < 10; $i++) {
            $weight = rand(50, 100);
            $height = rand(150, 190);
            $bmi = round($weight / (($height / 100) * ($height / 100)), 2);
            $score = rand(3, 22);
            $risk = 'Bajo';
            if ($score >= 7 && $score <= 11) {
                $risk = 'Ligeramente elevado';
            } elseif ($score >= 12 && $score <= 14) {
                $risk = 'Moderado';
            } elseif ($score >= 15 && $score <= 20) {
                $risk = 'Alto';
            } elseif ($score > 20) {
                $risk = 'Muy alto';
            }

            Survey::create([
                'uuid' => (string) Str::uuid(),
                'names' => $names[array_rand($names)],
                'surnames' => $surnames[array_rand($surnames)],
                'mail' => strtolower(Str::random(6)).'@example.com',
                'gender' => rand(0, 1) ? 'M' : 'F',
                'age' => rand(18, 80),
                'weight' => $weight,
                'height' => $height,
                'waist' => rand(70, 120),
                'daily_activity' => rand(0, 1) == 1 ? '0' : '2',
                'fruit_consumption' => rand(0, 1) == 1 ? '0' : '1',
                'antihypertensive_medication' => rand(0, 1) == 1 ? '2' : '0',
                'elevated_glucose' => rand(0, 1) == 1 ? '5' : '0',
                'family_history' => [0, 3, 5][array_rand([0, 3, 5])],
                'bmi' => $bmi,
                'score' => $score,
                'risk_level' => $risk,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }
    }
}
