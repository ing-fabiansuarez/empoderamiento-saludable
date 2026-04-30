#!/bin/bash
# =============================================================
# Script de deploy manual a Azure Container Apps
# USO: bash azure/deploy.sh
# =============================================================

# Configuración
ACR_NAME="acrencuestas"
CONTAINER_APP_NAME="encuestas-app"
CONTAINER_APP_RG="mentally-prod-rg"

IMAGE_TAG="manual-$(date +%Y%m%d%H%M)"
IMAGE_NAME="${ACR_NAME}.azurecr.io/encuestas-laravel:${IMAGE_TAG}"

echo ""
echo "======================================================"
echo " Deploy manual → Azure Container Apps"
echo " Imagen: $IMAGE_NAME"
echo "======================================================"

echo ""
echo "[1/4] Login al Azure Container Registry..."
az acr login --name "$ACR_NAME"

echo ""
echo "[2/4] Construyendo imagen Docker..."
docker build -t "$IMAGE_NAME" .

echo ""
echo "[3/4] Subiendo imagen al Registry..."
docker push "$IMAGE_NAME"

echo ""
echo "[4/4] Actualizando Container App..."
az containerapp update \
  --name "$CONTAINER_APP_NAME" \
  --resource-group "$CONTAINER_APP_RG" \
  --image "$IMAGE_NAME"

echo ""
echo "✅ ¡Deploy completado con éxito!"
echo "Tu aplicación actualizada debería estar disponible en 1-2 minutos."
