/**
 * Soft floating particle overlay for The Garrison.
 * Uses GSAP ticker when available; falls back to requestAnimationFrame.
 */
(function () {
  var canvas = document.getElementById("canvas");
  if (!canvas || !canvas.getContext) {
    return;
  }

  var ctx = canvas.getContext("2d");
  var particles = [];
  var particleCount = 36;
  var dpr = Math.min(window.devicePixelRatio || 1, 2);

  function resize() {
    canvas.width = Math.floor(window.innerWidth * dpr);
    canvas.height = Math.floor(window.innerHeight * dpr);
    canvas.style.width = window.innerWidth + "px";
    canvas.style.height = window.innerHeight + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function createParticle() {
    return {
      x: Math.random() * window.innerWidth,
      y: Math.random() * window.innerHeight,
      r: 1.5 + Math.random() * 2.5,
      vx: -0.25 + Math.random() * 0.5,
      vy: -0.4 + Math.random() * -0.2,
      alpha: 0.15 + Math.random() * 0.35,
    };
  }

  function init() {
    particles = [];
    for (var i = 0; i < particleCount; i++) {
      particles.push(createParticle());
    }
  }

  function draw() {
    ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
    for (var i = 0; i < particles.length; i++) {
      var p = particles[i];
      p.x += p.vx;
      p.y += p.vy;

      if (p.y < -10 || p.x < -10 || p.x > window.innerWidth + 10) {
        p.x = Math.random() * window.innerWidth;
        p.y = window.innerHeight + 10;
        p.vx = -0.25 + Math.random() * 0.5;
        p.vy = -0.4 + Math.random() * -0.2;
      }

      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = "rgba(206, 18, 18, " + p.alpha + ")";
      ctx.fill();
    }
  }

  resize();
  init();
  window.addEventListener("resize", function () {
    resize();
  });

  if (window.gsap && gsap.ticker) {
    gsap.ticker.add(draw);
  } else {
    (function loop() {
      draw();
      requestAnimationFrame(loop);
    })();
  }
})();
