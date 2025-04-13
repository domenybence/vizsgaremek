document.addEventListener("mousemove", function(e) {
    const x = e.clientX;
    const y = e.clientY;
    console.log = `X: ${x}, Y: ${y}`;
});