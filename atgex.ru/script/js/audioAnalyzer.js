export default function createAudioAnalyzer(audioElement) {
    const audioContext = new AudioContext();
    const audioSource = audioContext.createMediaElementSource(audioElement);
    const analyser = audioContext.createAnalyser();
    audioSource.connect(analyser);
    analyser.connect(audioContext.destination);
    analyser.fftSize = 256; // Устанавливаем размер FFT (Быстрое преобразование Фурье)
    const bufferLength = analyser.frequencyBinCount;
    const dataArray = new Uint8Array(bufferLength);

    return {
        analyser,
        bufferLength,
        dataArray
    };
}