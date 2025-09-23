(function ($) {
  "use strict";

  const $wrapper = $('.main-wrapper');
  const $pageWrapper = $('.page-wrapper');
  const $slimScrolls = $('.slimscroll');

  /**
   * -------------------------------
   * Sidebar Menu
   * -------------------------------
   */
  function initSidebarMenu() {
    $('#sidebar-menu a').on('click', function (e) {
      const $parent = $(this).parent();

      if ($parent.hasClass('submenu')) {
        e.preventDefault();
      }

      if (!$(this).hasClass('subdrop')) {
        $('ul', $(this).parents('ul:first')).slideUp(350);
        $('a', $(this).parents('ul:first')).removeClass('subdrop');
        $(this).next('ul').slideDown(350);
        $(this).addClass('subdrop');
      } else {
        $(this).removeClass('subdrop');
        $(this).next('ul').slideUp(350);
      }
    });

    // Active menu on load
    $('#sidebar-menu ul li.submenu a.active')
      .parents('li:last')
      .children('a:first')
      .addClass('active')
      .trigger('click');
  }

  /**
   * -------------------------------
   * Mobile Sidebar Toggle
   * -------------------------------
   */
  function initMobileSidebar() {
    $('body').append('<div class="sidebar-overlay"></div>');

    $(document).on('click', '#mobile_btn', function () {
      $wrapper.toggleClass('slide-nav');
      $('.sidebar-overlay').toggleClass('opened');
      $('html').addClass('menu-opened');
      return false;
    });

    $(".sidebar-overlay").on("click", function () {
      $wrapper.removeClass('slide-nav');
      $(".sidebar-overlay").removeClass("opened");
      $('html').removeClass('menu-opened');
    });
  }

  /**
   * -------------------------------
   * Sidebar Collapse (mini-sidebar)
   * -------------------------------
   */
  function initSidebarToggle() {
    $(document).on('click', '#toggle_btn', function () {
      if ($('body').hasClass('mini-sidebar')) {
        $('body').removeClass('mini-sidebar');
        $('.subdrop + ul').slideDown();
      } else {
        $('body').addClass('mini-sidebar');
        $('.subdrop + ul').slideUp();
      }

      // Redraw Morris.js charts if available
      if (typeof mA !== "undefined" && typeof mL !== "undefined") {
        setTimeout(function () {
          mA.redraw();
          mL.redraw();
        }, 300);
      }

      return false;
    });

    // Expand sidebar on hover
    $(document).on('mouseover', function (e) {
      e.stopPropagation();

      if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
        const insideSidebar = $(e.target).closest('.sidebar').length;

        if (insideSidebar) {
          $('body').addClass('expand-menu');
          $('.subdrop + ul').slideDown();
        } else {
          $('body').removeClass('expand-menu');
          $('.subdrop + ul').slideUp();
        }

        return false;
      }
    });
  }

  /**
   * -------------------------------
   * Page Height
   * -------------------------------
   */
  function adjustPageHeight() {
    if ($pageWrapper.length > 0) {
      const height = $(window).height();
      $pageWrapper.css("min-height", height);
    }
  }

  /**
   * -------------------------------
   * Plugins Init
   * -------------------------------
   */
  function initPlugins() {
    // Select2
    if ($('.select').length > 0 && $.fn.select2) {
      $('.select').select2({
        minimumResultsForSearch: -1,
        width: '100%'
      });
    }

    // Datetimepicker
    if ($('.datetimepicker').length > 0 && $.fn.datetimepicker) {
      $('.datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
          up: "fa fa-angle-up",
          down: "fa fa-angle-down",
          next: 'fa fa-angle-right',
          previous: 'fa fa-angle-left'
        }
      });

      $('.datetimepicker').on('dp.show', function () {
        $(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
      }).on('dp.hide', function () {
        $(this).closest('.temp').addClass('table-responsive').removeClass('temp');
      });
    }

    // Tooltip
    if ($('[data-toggle="tooltip"]').length > 0) {
      $('[data-toggle="tooltip"]').tooltip();
    }

    // DataTables
    if ($('.datatable').length > 0 && $.fn.DataTable) {
      $('.datatable').DataTable({
        "bFilter": false,
      });
    }

    // Summernote
    if ($('.summernote').length > 0 && $.fn.summernote) {
      $('.summernote').summernote({
        height: 200,
        focus: false
      });
    }

    // SlimScroll
    if ($slimScrolls.length > 0 && $.fn.slimScroll) {
      $slimScrolls.slimScroll({
        height: 'auto',
        width: '100%',
        position: 'right',
        size: '7px',
        color: '#ccc',
        allowPageScroll: false,
        wheelStep: 10,
        touchScrollStep: 100
      });

      const wHeight = $(window).height() - 60;
      $slimScrolls.height(wHeight);
      $('.sidebar .slimScrollDiv').height(wHeight);

      $(window).resize(function () {
        const rHeight = $(window).height() - 60;
        $slimScrolls.height(rHeight);
        $('.sidebar .slimScrollDiv').height(rHeight);
      });
    }

    // Pro Image Thumb
    if ($('.proimage-thumb li a').length > 0) {
      $(".proimage-thumb li a").on("click", function (e) {
        e.preventDefault();
        const full_image = $(this).attr("href");
        $(".pro-image img").attr("src", full_image);
        $(".pro-image img").parent().attr("href", full_image);
      });
    }

    // LightGallery
    if ($('#pro_popup').length > 0 && $.fn.lightGallery) {
      $('#pro_popup').lightGallery({
        thumbnail: true,
        selector: 'a'
      });
    }
  }

  /**
   * -------------------------------
   * Mailbox & Table utils
   * -------------------------------
   */
  function initMailbox() {
    // Check all
    $(document).on('click', '#check_all', function () {
      $('.checkmail').click();
      return false;
    });

    // Single check
    if ($('.checkmail').length > 0) {
      $('.checkmail').each(function () {
        $(this).on('click', function () {
          $(this).closest('tr').toggleClass('checked');
        });
      });
    }

    // Mark important
    $(document).on('click', '.mail-important', function () {
      $(this).find('i.fa').toggleClass('fa-star fa-star-o');
    });
  }

  /**
   * -------------------------------
   * Clickable rows
   * -------------------------------
   */
  function initClickableRows() {
    if ($('.clickable-row').length > 0) {
      $(document).on('click', '.clickable-row', function () {
        window.location = $(this).data("href");
      });
    }
  }

  /**
   * -------------------------------
   * Init all
   * -------------------------------
   */
  function init() {
    initSidebarMenu();
    initMobileSidebar();
    initSidebarToggle();
    adjustPageHeight();
    initPlugins();
    initMailbox();
    initClickableRows();

    // Adjust height on resize
    $(window).resize(adjustPageHeight);
  }

  // Start
  $(document).ready(init);

})(jQuery);
