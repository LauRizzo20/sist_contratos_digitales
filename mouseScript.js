document.addEventListener("DOMContentLoaded", function () {
  // Variables de elementos HTML
  const modalCanvas = document.getElementById("modal-canvas");
  const modalCtx = modalCanvas.getContext("2d");
  const colorTrazo = "#000";
  const anchoTrazo = "2";

  let isDrawing = false;
  let lastX = 0;
  let lastY = 0;

  // Función para dibujar trazos en el canvas
  function draw(e) {
    if (!isDrawing) return;

    modalCtx.strokeStyle = colorTrazo; // Color del trazo
    modalCtx.lineWidth = anchoTrazo; // Grosor del trazo
    modalCtx.lineJoin = "round";
    modalCtx.lineCap = "round";

    modalCtx.beginPath();
    modalCtx.moveTo(lastX, lastY);
    modalCtx.lineTo(e.offsetX, e.offsetY);
    modalCtx.stroke();

    [lastX, lastY] = [e.offsetX, e.offsetY];
  }

  // Eventos del mouse para dibujar
  modalCanvas.addEventListener("mousedown", (e) => {
    isDrawing = true;
    [lastX, lastY] = [e.offsetX, e.offsetY];
  });

  modalCanvas.addEventListener("mousemove", draw);
  modalCanvas.addEventListener("mouseup", () => (isDrawing = false));
  modalCanvas.addEventListener("mouseout", () => (isDrawing = false));


});
