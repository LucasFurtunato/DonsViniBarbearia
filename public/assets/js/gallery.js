const carousel = document.querySelector(".carousel");
firstImg = carousel.querySelectorAll("img")[0];
arrowIcons = document.querySelectorAll(".wrapper i");

let isDragStart = false,
    isDragging = false,
    prevPageX,
    prevScrollLeft,
    positionDiff;

const showHideIcons = () => {
  let scrollWidth = carousel.scrollWidth - carousel.clientWidth;
  arrowIcons[0].style.display = carousel.scrollLeft === 0 ? "none" : "block";
  arrowIcons[1].style.display = carousel.scrollLeft === scrollWidth ? "none" : "block";
};

arrowIcons.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImg.clientWidth + 14;
    carousel.scrollLeft += icon.id === "left" ? -firstImgWidth : firstImgWidth;
    
    setTimeout(() => showHideIcons(), 60);
  });
});

const autoSlide = () => {
  if (carousel.scrollLeft === carousel.scrollWidth - carousel.clientWidth) return;

  positionDiff = Math.abs(positionDiff);
  let firstImgWidth = firstImg.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiff;

  if (carousel.scrollLeft > prevScrollLeft) {
    carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
  } else {
    carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
  }
};

const dragStart = (e) => {
  isDragStart = true;
  prevPageX = e.pageX || e.touches[0].pageX;
  prevScrollLeft = carousel.scrollLeft;
};

const dragging = (e) => {
  if (!isDragStart) return;
  e.preventDefault();
  isDragging = true;
  carousel.classList.add("dragging");
  positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
  carousel.scrollLeft = prevScrollLeft - positionDiff;
  showHideIcons();
};

const dragStop = () => {
  isDragStart = false;
  carousel.classList.remove("dragging");

  if (!isDragging) return;
  isDragging = false;
  autoSlide();
};

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("touchstart", dragStart);

carousel.addEventListener("mousemove", dragging);
carousel.addEventListener("touchmove", dragging);

carousel.addEventListener("mouseup", dragStop);
carousel.addEventListener("mouseleave", dragStop);
carousel.addEventListener("touchend", dragStop);

$(function () {
  const fetchGalleryImages = async () => {
    try {
      await $.get("app/controllers/CtrlGaleria.php/get", function (response) {
        const parsedResponse = Array.isArray(response) ? response : JSON.parse(response);
        const imageUrls = parsedResponse.map((item) => ({
          imagem: item.imagem,
          id: item.galeriaId,
        }));
        addImagesToCarousel(imageUrls);
      });
    } catch (error) {
      console.error("Erro ao carregar as imagens:", error);
    }
  };

  const addImagesToCarousel = (images) => {
    $(".carousel").empty();
    images.forEach(function (imageData) {
      const imagePath = "app/" + imageData.imagem;
      const isAdmin = $(".carousel").hasClass("admin");
      const imageItem = `
        <div class="carousel-item" data-id="${imageData.id}">
          <img src="${imagePath}" alt="Image" draggable="false">
          ${
            isAdmin
              ? '<div class="overlay-buttons"><button class="remove-button" data-id="' +
                imageData.id +
                '">Remover</button></div>'
              : ""
          }
        </div>
      `;
      $(".carousel").append(imageItem);
    });

    firstImg = carousel.querySelectorAll("img")[0];
    showHideIcons();
  };

  $("#addCarouselImg").on("click", function () {
    $("#imageInput").click();
  });

  $("#imageInput").on("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const formData = new FormData();
      formData.append("image", file);

      $.ajax({
        url: "app/controllers/CtrlGaleria.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          const parsedResponse = JSON.parse(response);
          if (parsedResponse.success) {
            fetchGalleryImages();
          } else {
            console.error("Erro ao carregar a imagem:", parsedResponse.message);
          }
        },
        error: function (xhr, status, error) {
          console.error("Erro na requisição de upload:", error);
        },
      });
    }
  });

  $(".carousel").on('click', '.remove-button', function () {
    const imageId = $(this).data('id');
    handleRemoveImage(imageId);
  });

  const handleRemoveImage = (imageId) => {
    $.ajax({
      url: 'app/controllers/CtrlGaleria.php',
      type: 'DELETE',
      data: { id: imageId },
      success: function (response) {
        const parsedResponse = JSON.parse(response);
        if (parsedResponse.status == 200) {
          $(`.carousel-item[data-id=${imageId}]`).remove();
        } else {
          console.error('Erro ao remover a imagem:', parsedResponse.message);
        }
      },
      error: function (error) {
        console.error('Erro na requisição de remoção:', error);
      }
    });
  };

  fetchGalleryImages();
});


$(document).ready(function () {
  $.get("app/controllers/VfyLogin.php", function (dados) {
    var objRetorno = JSON.parse(dados);

    if (objRetorno.usrType == "cliente") {
      $("#inscrevase").hide();
      $("#aName").text(objRetorno.name);
      $("#agendaja").attr("href", "app/views/seu_agendamento.html")
      $("#aName").show();
      $("#aSair").show();
      $("#aAgenda").show();
      $("#aAgenda").attr("href", "app/views/seu_agendamento.html");
      $("#aEntrarUsr").hide();
      $("#aEntrarAdm").hide();
      $("#aEntrar").hide();
      $("#config").show();
      $("#config").attr("href", "app/views/alterar_perfil_cliente.html");
    } else if (objRetorno.usrType == "gerente") {
      $("#aName").text(objRetorno.name);
      $("#aName").show();
      $("#aSair").show();
      $("#aAgenda").show();
      $("#aAgenda").attr("href", "app/views/agenda.html");
      $("#aEntrarUsr").hide();
      $("#aEntrarAdm").hide();
      $("#aEntrar").hide();
    } else if (objRetorno.usrType == "funcionario") {
      $("#aName").text(objRetorno.name);
      $("#aName").show();
      $("#aSair").show();
      $("#aAgenda").show();
      $("#aAgenda").attr("href", "app/views/agenda.html");
      $("#aEntrarUsr").hide();
      $("#aEntrarAdm").hide();
      $("#aEntrar").hide();
      $("#config").show();
      $("#config").attr("href", "app/views/alterar_perfil_adminfun.html");
    } else {
      $("#inscrevase").attr("href", "app/views/login-cadastro.html")     
      $("#agendaja").attr("href", "app/views/login-cadastro.html")
      $("#aName").hide();
      $("#aSair").hide();
      $("#config").hide();
      $("#aAgenda").hide();
      $("#aEntrarUsr").show();
      $("#aEntrarAdm").show();
      $("#aEntrar").show();
    }
  });
});