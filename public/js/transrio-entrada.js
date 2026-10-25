document.addEventListener('DOMContentLoaded', function() {
    const entrada = document.getElementById('transrio-entrada');
    if (!entrada) return;
    const frases = document.querySelectorAll('.frase');
    let index = 0;
    if (frases.length > 0) frases[0].classList.add('activa');
    const intervalo = setInterval(() => {
        if (frases[index]) frases[index].classList.remove('activa');
        index++;
        if (index < frases.length) frases[index].classList.add('activa');
        else clearInterval(intervalo);
    }, 1200);
    setTimeout(() => {
        entrada.classList.add('oculto');
        setTimeout(() => {
            if (window.map) window.map.invalidateSize();
            setTimeout(() => entrada.remove(), 800);
        }, 100);
    }, 4000);
});
