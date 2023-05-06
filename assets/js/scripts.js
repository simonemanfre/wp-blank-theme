//MODAL
function openModal(modalId) {
  if (modalId) {
    jQuery(modalId).fadeIn(200);
    jQuery("body").addClass("u-modal-open");
  }
}

function closeModals() {
  jQuery(".c-modal").fadeOut(200);
  jQuery("body").removeClass("u-modal-open");
}

//SUB MENÙ
function openSubMenu(target) {
  jQuery(target).addClass("u-is-open");
  jQuery(target).find(".sub-menu").slideDown();
}

function closeSubMenu() {
  jQuery(".menu-item-has-children.u-is-open").find(".sub-menu").slideUp();
  jQuery(".menu-item-has-children.u-is-open").removeClass("u-is-open");
}

//MEGAMENÙ
function openMegamenu(clickedEl, target) {
  //chiudo eventuali sottomenù aperti
  closeSubMenu();

  //chiudo altri megamenù
  if (jQuery("body").hasClass("u-megamenu-open")) {
    jQuery(".menu-item-has-megamenu.u-is-open").removeClass("u-is-open");
    jQuery(".c-megamenu.u-is-open").hide();
  }

  //apro megamenù corrente
  jQuery("body").addClass("u-megamenu-open");
  clickedEl.addClass("u-is-open");
  jQuery(target).addClass("u-is-open");
  jQuery(target).slideDown();
}

function closeMegamenu() {
  //chiudo il megamenù se è aperto
  if (jQuery("body").hasClass("u-megamenu-open")) {
    jQuery("body").removeClass("u-megamenu-open");
    jQuery(".menu-item-has-megamenu.u-is-open").removeClass("u-is-open");
    jQuery(".c-megamenu.u-is-open").hide();
  }
}

jQuery(document).ready(function ($) {
  //MENÙ
  jQuery(".j-toggle").click(function () {
    if (document.body.classList.contains("u-megamenu-open")) {
      //se il megamenù è aperto lo chiudo
      closeMegamenu();
    } else {
      //apro o chiudo il menù
      jQuery("body").toggleClass("u-menu-open");
    }

    return false;
  });

  //SUB MENÙ
  jQuery(".j-has-submenu > a").click(function () {
    if (jQuery(this).parent().hasClass("u-is-open")) {
      //se il sottomenù è aperto chiudo sottomenù
      closeSubMenu();
    } else {
      //se il sottomenù è chiuso
      //chiudo megamenù
      closeMegamenu();

      //apro sottomenù
      let target = jQuery(this).parent();
      openSubMenu(target);
    }

    return false;
  });

  /*
  //se la freccia non è fatta in CSS o deve essere cliccabile aggiungo il markup
  //aggiungo freccia al sottomenù
  jQuery(".menu-item-has-children > a").append(
    '<span class="menu-item__arrow u-mobile j-toggle-submenu"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.41 7.84 12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/></svg></span>'
  );
  */

  /*
  //se la prima voce di menù ha un link, il sottomenù si aprirà all':hover su desktop e al click sulla freccia su mobile
  //apro sottomenù al click sulla freccia
  jQuery(document).on("click", ".j-toggle-submenu", function () {
    jQuery(this).closest(".menu-item").find(".sub-menu").slideToggle();

    return false;
  });
  */

  //MEGAMENÙ
  //ricordarsi di aggiungere classi "j-megamenu" e "menu-item-has-megamenu" alla voce di menù di wordpress
  jQuery(".j-megamenu").click(function () {
    let clickedEl = jQuery(this);
    if (clickedEl.hasClass("u-is-open")) {
      //se il megamenù è aperto chiudo megamenù corrente
      closeMegamenu();
    } else {
      //se il megamenù è chiuso apro megamenù corrente
      let target = "#megamenu-header";
      openMegamenu(clickedEl, target);
    }

    return false;
  });

  //MODAL
  jQuery(".j-modal-open").click(function () {
    let target;
    target = jQuery(this).attr("data-target") || jQuery(this).attr("href");

    openModal(target);

    return false;
  });

  jQuery(".j-modal-close").click(function () {
    closeModals();

    return false;
  });

  //CLICK OUTSIDE
  jQuery(document).click(function (event) {
    let target = jQuery(event.target);

    if (!target.closest(".c-modal-container").length) {
      closeModals();
    }

    //chiudo megamenù
    if (
      !target.closest(".c-megamenu").length &&
      !target.closest(".menu-item-has-megamenu").length
    ) {
      closeMegamenu();
    }

    //chiudo sottomenù
    if (
      !target.closest(".sub-menu").length &&
      !target.closest(".menu-item-has-children").length
    ) {
      closeSubMenu();
    }
  });

  //ESCAPE KEY
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeModals();

      //chiudo megamenù
      closeMegamenu();

      //chiudo sottomenù
      closeSubMenu();
    }
  });

  //CLOSE SUB MENÙ ON SCROLL ONLY DESKTOP
  document.addEventListener("scroll", (event) => {
    function isDesktopScroll(x) {
      if (x.matches) {
        //chiudo megamenù
        closeMegamenu();

        //chiudo sottomenù
        closeSubMenu();
      }
    }
    let x = window.matchMedia("(min-width: 1024px)");
    isDesktopScroll(x);
    x.addListener(isDesktopScroll);
  });

  //SMOOTH SCROLL
  jQuery("a").on("click", function (event) {
    if (this.hash !== "") {
      var hash = this.hash;
      if (jQuery(hash).offset() != undefined) {
        event.preventDefault();
        jQuery("html, body").animate(
          {
            scrollTop: jQuery(hash).offset().top - 92,
          },
          800
        );
      }
    }
  });

  if (phpVars.infiniteScroll) {
    //INFINITE SCROLL WITH BUTTON
    let infiniteScrollPosts = new InfiniteScroll(".c-container", {
      // options
      path: ".j-next-button",
      append: ".c-items",
      button: ".j-next-button",
      status: ".c-loader",
      scrollThreshold: false,
      history: false,
    });

    //INFINITE SCROLL NO BUTTON
    let infiniteScrollBlog = new InfiniteScroll(".c-container", {
      // options
      path: ".j-next-button",
      append: ".c-items",
      status: ".c-loader",
      hideNav: ".j-next-button",
      history: false,
    });
  }

  //SCROLLNAV solo in singoli post o pagine
  if (phpVars.scrollNav) {
    jQuery(".c-post-content").scrollNav({
      sections: "h2:not(.disable-nav), h3:not(.disable-nav)",
      insertTarget: ".c-nav",
      showHeadline: false,
      showTopLink: false,
      insertLocation: "appendTo",
      scrollOffset: 80,

      onRender: function () {
        jQuery(".scroll-nav__link").prepend(
          '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g clip-path="url(#a)"><path d="M8.646 3.854a.5.5 0 1 1 .708-.708l4.5 4.5s0 .002.002.002a.496.496 0 0 1 0 .703l-.003.003-4.5 4.5a.5.5 0 0 1-.707-.708L12.293 8.5H2.5a.5.5 0 0 1 0-1h9.793L8.646 3.854Z"/></g><defs><clipPath id="a"><path fill="#fff" d="M16 0H0v16h16z"/></clipPath></defs></svg>'
        );
      },
    });
  }

  //HEADROOM STICKY HEADER
  /*
  var options = {
    // vertical offset in px before element is first unpinned
    offset: 100,
    // scroll tolerance in px before state changes
    tolerance: 100,
  };
  var myElement = document.querySelector(".c-site-header");
  var headroom = new Headroom(myElement, options);
  headroom.init();
  */

  //SLIDER
  if (phpVars.swiperSlider) {
    //slider singolo
    let swiperReviewOptions = {
      slidesPerView: 1,
      speed: 6000,
      spaceBetween: 32,
      grabCursor: true,
      loop: true,
      centeredSlides: false,
      rewind: false,
      cssMode: false,
      autoHeight: false,
      autoplay: {
        delay: 4000, //set to 1 for continuous scroll
        disableOnInteraction: true, //set to false for continuous scroll
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    };

    let swiperReview = new Swiper("#swiper-review", swiperReviewOptions);

    //slider multipli
    let swiperSliderOptions = {
      slidesPerView: 1,
      speed: 6000,
      loop: true,
      centeredSlides: false,
      grabCursor: true,
      spaceBetween: 32,
    };

    let sliders = document.querySelectorAll(".swiper");
    [...sliders].map((slider) => {
      let swiperSlider = new Swiper(slider, swiperSliderOptions);
    });
  }

  //FANCYBOX
  if (phpVars.fancybox) {
    Fancybox.bind("[data-fancybox]", {});

    /* ESEMPIO SLIDER
    IMPORTANTE: ATTRIBUIRE AGLI SLIDER LE CLASSI carousel e carousel__slide
    let sliders = document.querySelectorAll(".carousel");
    let sliderPicture = [];

    for (i = 0; i < sliders.length; ++i) {
      sliderPicture[i] = new Carousel(sliders[i], {
        slidesPerPage: 1,
        center: false,
        Navigation: {
          prevTpl:
            '<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m17.7 4.437-8.056 8.055 8.056 8.056-1.69 1.69-8.908-8.909-.801-.837.808-.845 8.9-8.9 1.691 1.69Z" fill="#142F42"/></svg>',
          nextTpl:
            '<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m6.3 20.548 8.056-8.056L6.3 4.437l1.69-1.69 8.908 8.908.801.837-.808.845-8.9 8.9-1.691-1.69Z" fill="#142F42"/></svg>',
        },
      });
    }
    */
  }

  //CF7
  if (phpVars.cf7) {
    //CF7 ACCEPTANCE + CHECKBOX
    jQuery(".wpcf7-form-control .wpcf7-list-item").each(function () {
      let container = jQuery(this);
      let label_old = container.find("label");

      container.addClass("c-checkbox");
      label_old.replaceWith(label_old.html());

      let label_new = container.find(".wpcf7-list-item-label");
      let input = container.find("input[type=checkbox]");

      label_new.replaceWith(
        '<label for="' +
          input.attr("name") +
          '">' +
          label_new.html() +
          "</label>"
      );

      container.append("<span></span>");
      input.attr("id", jQuery(input).attr("name"));
    });

    //CF7 RADIO
    jQuery(".wpcf7-radio .wpcf7-list-item").each(function () {
      let container = jQuery(this);
      let label_old = container.find("label");

      container.addClass("c-radio");
      label_old.replaceWith(label_old.html());

      let label_new = container.find(".wpcf7-list-item-label");
      let input = container.find("input[type=radio]");

      label_new.replaceWith(
        '<label for="' +
          input.attr("value") +
          '"><strong>' +
          label_new.html() +
          "</strong></label>"
      );

      container.append("<span></span>");
      input.attr("id", jQuery(input).attr("value"));
    });

    //CF7 SELECT
    jQuery(".wpcf7-select").each(function () {
      jQuery(this).wrap('<div class="c-select"></div>');
    });
  }

  //WOOCOMMERCE
  if (phpVars.woocommerce) {
    //aggiungo classe ai prodotti correlati e upsells
    const related = document.querySelector(".related.products");
    const upsells = document.querySelector(".upsells.products");

    if (related) {
      const relatedProducts = related.querySelectorAll(".product");

      [...relatedProducts].map((item) => {
        item.classList.add("c-product");
      });
    }
    if (upsells) {
      const upsellsProducts = upsells.querySelectorAll(".product");

      [...upsellsProducts].map((item) => {
        item.classList.add("c-product");
      });
    }
  }
});

//SMOOTH SCROLLING ON PAGE LOAD
let target = window.location.hash;
window.location.hash = "";

window.addEventListener("DOMContentLoaded", function () {
  //Qui l'HTML della pagina è stato caricato ma senza le risorse (style, img, js, iframe)
});

window.addEventListener("load", function () {
  //Qui la pagina è stata caricata con anche tutte le risorse

  //SMOOTH SCROLLING ON PAGE LOAD
  if (target && jQuery(target).offset() != undefined) {
    jQuery("html, body").animate(
      {
        scrollTop: jQuery(target).offset().top - 50,
      },
      800
    );
  }
});
