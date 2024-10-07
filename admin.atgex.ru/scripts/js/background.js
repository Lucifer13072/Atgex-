const canvas = document.getElementById('canvas-line');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const lines = [];
const colors = ['#3d4242', '#285c5c', '#28435c', '#043869'];

function Line() {
    this.x = Math.random() * canvas.width;
    this.y = 0;
    this.length = Math.random() * 100 + 50;
    this.speed = Math.random() * 2 + 1;
    this.color = colors[Math.floor(Math.random() * colors.length)];
}

Line.prototype.draw = function () {
    ctx.beginPath();
    ctx.strokeStyle = this.color;
    ctx.moveTo(this.x, this.y);
    ctx.lineTo(this.x, this.y + this.length);
    ctx.stroke();
}

Line.prototype.update = function () {
    this.y += this.speed;
    if (this.y > canvas.height) {
        this.y = 0;
        this.x = Math.random() * canvas.width;
    }
}

function createLines() {
    for (let i = 0; i < 50; i++) {
        lines.push(new Line());
    }
}

function drawLines() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    lines.forEach(line => {
        line.draw();
    });
}

function updateLines() {
    lines.forEach(line => {
        line.update();
    });
}

function loop() {
    drawLines();
    updateLines();
    requestAnimationFrame(loop);
}

createLines();
loop();