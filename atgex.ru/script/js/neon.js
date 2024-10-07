import createAudioAnalyzer from './audioAnalyzer.js';

let audioAnalyzer;
let scene, camera, renderer;
let coreSphere, outerSphere, plasmaSphere;
let numCoreParticles = 10000;
let numPlasmaParticles = 700;
let coreRadius = 0.3;
let plasmaRadius = 0.8;
let outerRadius = 1.3;
let coreColor = 0x349fd1;
let outerColor = 0xffffff;
let plasmaColor = 0x0ea5f0;
let outerRotationSpeed;
let canvasContainer;

init();

function updateScale() {
    const width = canvasContainer.clientWidth;
    const height = canvasContainer.clientHeight;
    const scale = Math.min(width, height) / 500; // Подберите масштаб по вашему усмотрению

    coreSphere.scale.set(scale, scale, scale);
    outerSphere.scale.set(scale, scale, scale);
    plasmaSphere.scale.set(scale, scale, scale);
}

function init() {
    const canvasContainer = document.getElementById('canvas-container');
    
    scene = new THREE.Scene();
    
    camera = new THREE.PerspectiveCamera(40, 1, 0.1, 100000000); // Начальная пропорция будет 1:1
    camera.position.z = 5;

    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setPixelRatio(window.devicePixelRatio);
    
    updateRendererSize(); // Обновляем размеры рендерера при инициализации
    canvasContainer.appendChild(renderer.domElement);

    createCoreSphere();
    createOuterSphere();
    createPlasmaSphere();

    const ambientLight = new THREE.AmbientLight(0x404040);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff);
    directionalLight.position.set(1, 1, 1).normalize();
    scene.add(directionalLight);

    // Установим обработчик события изменения размера окна
    window.addEventListener('resize', updateRendererSize);

    // Установим обработчик клика для инициализации аудио
    canvasContainer.addEventListener('click', initAudio);

    animate(); // Запуск анимационного цикла
}

function updateRendererSize() {
    const canvasContainer = document.getElementById('canvas-container');
    const width = canvasContainer.clientWidth;
    const height = canvasContainer.clientHeight;

    renderer.setSize(width, height);
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
}

function onWindowResize() {
    // Обновление размеров рендерера и камеры
    renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
    camera.aspect = canvasContainer.clientWidth / canvasContainer.clientHeight;
    camera.updateProjectionMatrix();
    updateScale();
}


let audioInitialized = false;

function initAudio() {
    if (!audioInitialized) { // Check if audio has been initialized
        const audioElement = new Audio('Neon Shadows.mp3');
        audioAnalyzer = createAudioAnalyzer(audioElement);
        audioElement.play(); // Start audio
        audioInitialized = true; // Set audio initialization flag
    }
}
// Click event handler to start audio
canvasContainer.addEventListener('click', function(event) {
    if (!audioInitialized) {
        initAudio(); // Start audio if not initialized yet
    }
    event.stopPropagation(); // Stop event propagation to avoid multiple initAudio calls
    return false;
});

function createCoreSphere() {
    const coreGeometry = new THREE.BufferGeometry();
    const coreMaterial = new THREE.PointsMaterial({
        size: 0.01,
        color: coreColor,
        transparent: true,
        blending: THREE.AdditiveBlending
    });

    const coreVertices = [];

    for (let i = 0; i < numCoreParticles; i++) {
        const phi = Math.random() * Math.PI * 2;
        const theta = Math.random() * Math.PI * 2;

        const x = Math.sin(phi) * Math.cos(theta) * coreRadius;
        const y = Math.sin(phi) * Math.sin(theta) * coreRadius;
        const z = Math.cos(phi) * coreRadius;

        coreVertices.push(x, y, z);
    }

    coreGeometry.setAttribute('position', new THREE.Float32BufferAttribute(coreVertices, 3));

    coreSphere = new THREE.Points(coreGeometry, coreMaterial);
    coreSphere.geometry.computeBoundingSphere();
    scene.add(coreSphere);
}

function createOuterSphere() {
    const outerGeometry = new THREE.BufferGeometry();
    const outerMaterial = new THREE.PointsMaterial({
        size: 0.003,
        color: outerColor,
        transparent: true,
        blending: THREE.AdditiveBlending
    });

    const outerVertices = [];

    // Увеличиваем количество частиц в кластере
    const numOuterClusterParticles = 10000;

    for (let i = 0; i < numOuterClusterParticles; i++) {
        const phi = Math.random() * Math.PI * 2;
        const theta = Math.random() * Math.PI * 2;

        const x = Math.sin(phi) * Math.cos(theta) * outerRadius;
        const y = Math.sin(phi) * Math.sin(theta) * outerRadius;
        const z = Math.cos(phi) * outerRadius;

        outerVertices.push(x, y, z);
    }

    outerGeometry.setAttribute('position', new THREE.Float32BufferAttribute(outerVertices, 3));

    outerSphere = new THREE.Points(outerGeometry, outerMaterial);
    outerSphere.geometry.computeBoundingSphere();
    scene.add(outerSphere);

    outerRotationSpeed = new THREE.Vector3(
        Math.random() * 0.01 - 0.012,
        Math.random() * 0.01 - 0.013,
        Math.random() * 0.01 - 0.011
    );

    clusterParticles(outerSphere, 130, 0.28); // Увеличиваем количество кластеров внешней сферы
}


function createPlasmaSphere() {
    const plasmaGeometry = new THREE.BufferGeometry();
    const plasmaMaterial = new THREE.PointsMaterial({
        size: 0.03,
        color: plasmaColor,
        transparent: true,
        blending: THREE.AdditiveBlending
    });

    const plasmaVertices = [];

    for (let i = 0; i < numPlasmaParticles; i++) {
        const phi = Math.random() * Math.PI * 2;
        const theta = Math.random() * Math.PI * 2;

        const x = Math.sin(phi) * Math.cos(theta) * plasmaRadius;
        const y = Math.sin(phi) * Math.sin(theta) * plasmaRadius;
        const z = Math.cos(phi) * plasmaRadius;

        plasmaVertices.push(x, y, z);
    }

    plasmaGeometry.setAttribute('position', new THREE.Float32BufferAttribute(plasmaVertices, 3));

    plasmaSphere = new THREE.Points(plasmaGeometry, plasmaMaterial);
    plasmaSphere.geometry.computeBoundingSphere();
    scene.add(plasmaSphere);
}

function animate() {
    requestAnimationFrame(animate);

    if (audioAnalyzer) {
        // Получаем данные анализатора
        audioAnalyzer.analyser.getByteFrequencyData(audioAnalyzer.dataArray);

        // Пульсирующие частицы внешнего слоя
        const outerPulseStrength = audioAnalyzer.dataArray.reduce((a, b) => a + b, 0) / (audioAnalyzer.bufferLength * 255);
        outerSphere.scale.set(1 + outerPulseStrength * 0.5, 1 + outerPulseStrength * 0.5, 1 + outerPulseStrength * 0.5);

        // Пульсирующие частицы плазмы
        const plasmaPulseStrength = audioAnalyzer.dataArray.reduce((a, b) => a + b, 0) / (audioAnalyzer.bufferLength * 255);
        plasmaSphere.scale.set(1 + plasmaPulseStrength * 0.5, 1 + plasmaPulseStrength * 0.5, 1 + plasmaPulseStrength * 0.5);

        // Добавление анимации для частиц плазмы
    }

    animatePlasmaParticles();
    animateParticles(coreSphere);


    outerSphere.rotation.x += outerRotationSpeed.x;
    outerSphere.rotation.y += outerRotationSpeed.y;
    outerSphere.rotation.z += outerRotationSpeed.z;

    renderer.render(scene, camera);
}

function animatePlasmaParticles() {
    const positions = plasmaSphere.geometry.attributes.position.array;

    for (let i = 0; i < positions.length; i += 3) {
        const displacement = new THREE.Vector3(
            (Math.random() - 0.5) * 0.02, // Регулируйте скорость и хаотичность движения
            (Math.random() - 0.5) * 0.02,
            (Math.random() - 0.5) * 0.02
        );

        positions[i] += displacement.x;
        positions[i + 1] += displacement.y;
        positions[i + 2] += displacement.z;

        // Ограничение движения частиц вокруг ядра
        const distanceToCore = Math.sqrt(
            positions[i] * positions[i] +
            positions[i + 1] * positions[i + 1] +
            positions[i + 2] * positions[i + 2]
        );

        const maxDistance = plasmaRadius; // Радиус, в пределах которого частицы должны оставаться
        if (distanceToCore > maxDistance) {
            // Если частица вышла за пределы радиуса, переместите ее обратно к ядру
            positions[i] *= maxDistance / distanceToCore;
            positions[i + 1] *= maxDistance / distanceToCore;
            positions[i + 2] *= maxDistance / distanceToCore;
        }
    }

    // Обновление позиций частиц
    plasmaSphere.geometry.attributes.position.needsUpdate = true;
}

function animateParticles(particleSystem) {
    const positions = particleSystem.geometry.attributes.position.array;

    for (let i = 0; i < positions.length; i += 3) {
        // Двигаем частицы в рандомном направлении
        const displacement = new THREE.Vector3(
            (Math.random() - 0.5) * 0.013,
            (Math.random() - 0.5) * 0.013,
            (Math.random() - 0.5) * 0.013
        );

        positions[i] += displacement.x;
        positions[i + 1] += displacement.y;
        positions[i + 2] += displacement.z;

        // Обновляем плавающую форму облака
        positions[i] += Math.sin(positions[i] * 0.1) * 2; // Пример изменения плавающей формы по x
        positions[i + 1] += Math.sin(positions[i + 1] * 0.1) * 2; // Пример изменения плавающей формы по y
        positions[i + 2] += Math.sin(positions[i + 2] * 0.1) * 2; // Пример изменения плавающей формы по z

        // Проверяем границы ядра и обновляем положение частицы при необходимости
        const radius = particleSystem === coreSphere ? coreRadius : (particleSystem === outerSphere ? outerRadius : plasmaRadius);
        const distance = Math.sqrt(
            positions[i] * positions[i] +
            positions[i + 1] * positions[i + 1] +
            positions[i + 2] * positions[i + 2]
        );

        if (distance > radius) {
            positions[i] *= radius / distance;
            positions[i + 1] *= radius / distance;
            positions[i + 2] *= radius / distance;
        }
    }

    // Обновляем положения частиц
    particleSystem.geometry.attributes.position.needsUpdate = true;
}

// Particle clustering function
function clusterParticles(particleSystem, numClusters, clusterRadius) {
    const positions = particleSystem.geometry.attributes.position.array;
    const clusters = new Array(numClusters).fill().map(() => ({
        x: Math.random() * 2 - 1,
        y: Math.random() * 2 - 1,
        z: Math.random() * 2 - 1,
        count: 0
    }));

    // Find nearest cluster for each particle
    for (let i = 0; i < positions.length; i += 3) {
        let minDistance = Infinity;
        let closestClusterIndex = 0;

        for (let j = 0; j < numClusters; j++) {
            const distance = Math.sqrt(
                Math.pow(clusters[j].x - positions[i], 2) +
                Math.pow(clusters[j].y - positions[i + 1], 2) +
                Math.pow(clusters[j].z - positions[i + 2], 2)
            );

            if (distance < minDistance) {
                minDistance = distance;
                closestClusterIndex = j;
            }
        }

        clusters[closestClusterIndex].count++;
        clusters[closestClusterIndex].x += positions[i];
        clusters[closestClusterIndex].y += positions[i + 1];
        clusters[closestClusterIndex].z += positions[i + 2];
    }

    // Move particles smoothly towards cluster centers
    for (let i = 0; i < numClusters; i++) {
        if (clusters[i].count > 0) {
            clusters[i].x /= clusters[i].count;
            clusters[i].y /= clusters[i].count;
            clusters[i].z /= clusters[i].count;

            for (let j = 0; j < positions.length; j += 3) {
                const distanceToCluster = Math.sqrt(
                    Math.pow(clusters[i].x - positions[j], 2) +
                    Math.pow(clusters[i].y - positions[j + 1], 2) +
                    Math.pow(clusters[i].z - positions[j + 2], 2)
                );

                if (distanceToCluster < clusterRadius) {
                    // Smoothly move particles towards cluster centers
                    const factor = 1; // Adjust the factor for smoother movement
                    positions[j] += (clusters[i].x - positions[j]) * factor;
                    positions[j + 1] += (clusters[i].y - positions[j + 1]) * factor;
                    positions[j + 2] += (clusters[i].z - positions[j + 2]) * factor;
                }
            }
        }
    }

    // Update particle positions
    particleSystem.geometry.attributes.position.needsUpdate = true;
}