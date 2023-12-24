document.addEventListener("DOMContentLoaded", function () {
  // NUEVO CODIGO
  const canvas = document.getElementById("modal-canvas");
  const context = canvas.getContext("2d");
  const viewport = window.visualViewport;
  var offsetX;
  var offsetY;
  const colorTrazo = "#000";
  const anchoTrazo = "2";

  canvas.addEventListener("touchstart", handleStart);
  canvas.addEventListener("touchend", handleEnd);
  canvas.addEventListener("touchcancel", handleCancel);
  canvas.addEventListener("touchmove", handleMove);

  const ongoingTouches = [];

  function handleStart(evt) {
    evt.preventDefault();
    const touches = evt.changedTouches;
    offsetX = canvas.getBoundingClientRect().left;
    offsetY = canvas.getBoundingClientRect().top;
    for (let i = 0; i < touches.length; i++) {
      ongoingTouches.push(copyTouch(touches[i]));
    }
  }

  function handleMove(evt) {
    evt.preventDefault();
    const touches = evt.changedTouches;
    for (let i = 0; i < touches.length; i++) {
      const color = colorTrazo;
      const idx = ongoingTouchIndexById(touches[i].identifier);
      if (idx >= 0) {
        context.beginPath();
        context.moveTo(
          ongoingTouches[idx].clientX - offsetX,
          ongoingTouches[idx].clientY - offsetY
        );
        context.lineTo(
          touches[i].clientX - offsetX,
          touches[i].clientY - offsetY
        );
        context.lineWidth = anchoTrazo;
        context.strokeStyle = color;
        context.lineJoin = "round";
        context.closePath();
        context.stroke();
        ongoingTouches.splice(idx, 1, copyTouch(touches[i])); // swap in the new touch record
      }
    }
  }

  function handleEnd(evt) {
    evt.preventDefault();
    const touches = evt.changedTouches;
    for (let i = 0; i < touches.length; i++) {
      const color = colorTrazo;
      let idx = ongoingTouchIndexById(touches[i].identifier);
      if (idx >= 0) {
        context.lineWidth = anchoTrazo;
        context.fillStyle = color;
        ongoingTouches.splice(idx, 1); // remove it; we're done
      }
    }
  }

  function handleCancel(evt) {
    evt.preventDefault();
    const touches = evt.changedTouches;
    for (let i = 0; i < touches.length; i++) {
      let idx = ongoingTouchIndexById(touches[i].identifier);
      ongoingTouches.splice(idx, 1); // remove it; we're done
    }
  }

  function copyTouch({ identifier, clientX, clientY }) {
    return { identifier, clientX, clientY };
  }

  function ongoingTouchIndexById(idToFind) {
    for (let i = 0; i < ongoingTouches.length; i++) {
      const id = ongoingTouches[i].identifier;
      if (id === idToFind) {
        return i;
      }
    }
    return -1; // not found
  }

  function clearArea() {
    context.setTransform(1, 0, 0, 1, 0, 0);
    context.clearRect(0, 0, context.canvas.width, context.canvas.height);
  }
});
