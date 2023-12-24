document.addEventListener("DOMContentLoaded", function () {
  const signatureCanvas = document.getElementById("signature-canvas");
  const openModalButton = document.getElementById("open-modal-button");
  const closeModalButton = document.getElementById("close-modal-button");
  const clearSignatureButton = document.getElementById("clear-signature-button");
  const saveSignatureButton = document.getElementById("save-signature-button");
  const modalCanvas = document.getElementById("modal-canvas");
  const genPdf = document.getElementById("enviar");
  const modalCtx = modalCanvas.getContext("2d");

  const signatureCtx = signatureCanvas.getContext("2d");
  // Abrir modal
  openModalButton.addEventListener("click", function () {
    signatureCtx.clearRect(0, 0, signatureCanvas.width, signatureCanvas.height);
    modal.style.display = "block";
  });

  // Cerrar modal
  closeModalButton.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Borrar firma
  clearSignatureButton.addEventListener("click", function () {
    modalCtx.clearRect(0, 0, modalCanvas.width, modalCanvas.height);
  });

  // Guardar firma
  saveSignatureButton.addEventListener("click", function () {
    signatureCtx.drawImage(modalCanvas, 0, 0);
    modalCtx.clearRect(0, 0, modalCanvas.width, modalCanvas.height);
    modal.style.display = "none";
  });
  // Guardar firma
  genPdf.addEventListener("click", function () {
    // Obtener los datos de la firma del canvas modal como una imagen base64
    const signatureData = signatureCanvas.toDataURL("image/png");

    // Crear un campo de formulario oculto y adjuntar los datos de la firma
    const hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = "signature";
    hiddenInput.id = "signature";
    hiddenInput.value = signatureData;

    // Agregar el campo de formulario al formulario existente
    const form = document.querySelector("form");
    form.appendChild(hiddenInput);

    // Enviar el formulario al archivo PHP
    form.submit();

    // Limpiar el canvas principal
    signatureCtx.clearRect(0, 0, signatureCanvas.width, signatureCanvas.height);
  });
});
