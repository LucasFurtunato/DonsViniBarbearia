const carousel = document.querySelector(".carousel");
firstImg = carousel.querySelectorAll("img")[0];
arrowIcons = document.querySelectorAll(".wrapper i");

let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;

const showHideIcons = () => {
    // Mostrando e escondendo ícone de retroceder/avançar de acordo com o valor de rolagem esquerda do carrosel
    let scrollWidth = carousel.scrollWidth - carousel.clientWidth; // Pegando a largura máxima de rolagem
    arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
    arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
}

arrowIcons.forEach(icon => {
    icon.addEventListener("click", () => {
        let firstImgWidth = firstImg.clientWidth + 14; // Pegando a largura da primeira imagem e adicionando 14 de margem
        //Se o ícone clicado for o da esquerda, reduzir largura da rolagem do lado esquerdo do carrosel, caso contrário adicionar a isso
        carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
        setTimeout(() => showHideIcons(), 60); // Chamando showHideIcons depois de 60ms
    });
});

const autoSlide = () => {
    // Se não houver nenhuma imagem à esquerda da rolagem, então retorne daqui
    if(carousel.scrollLeft == (carousel.scrollWidth - carousel.clientWidth)) return;

    positionDiff = Math.abs(positionDiff); // Fazendo positionDiff ter valores positivos
    let firstImgWidth = firstImg.clientWidth + 14;
    // Pegando a diferença de valor que precisa para aumentar ou reduzir o lado esquerdo do carrosel para colocar a imagem no centro
    let valDifference = firstImgWidth - positionDiff;

    if(carousel.scrollLeft > prevScrollLeft) { // Se o usuário está rolando para a direita
        return carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
    }
    // Se o usuário está rolando para a esquerda
    carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
}

const dragStart = (e) => {
    // Atualizando os valores das variáveis globais no evento "mouse down"
    isDragStart = true;
    prevPageX = e.pageX || e.touches[0].pageX;
    prevScrollLeft = carousel.scrollLeft;
}

const dragging  = (e) => {
    // Movendo imagens para esquerda de acordo com o cursor
    if(!isDragStart) return;
    e.preventDefault();
    isDragging = true;
    carousel.classList.add("dragging");
    positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
    carousel.scrollLeft = prevScrollLeft - positionDiff;
    showHideIcons();
}

const dragStop = () => {
    isDragStart = false;
    carousel.classList.remove("dragging");

    if(!isDragging) return;
    isDragging = false;
    autoSlide();
}

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("touchstart", dragStart);

carousel.addEventListener("mousemove", dragging);
carousel.addEventListener("touchmove", dragging);

carousel.addEventListener("mouseup", dragStop);
carousel.addEventListener("mouseleave", dragStop);
carousel.addEventListener("touchend", dragStop);
