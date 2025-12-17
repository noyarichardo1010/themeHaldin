var spinner = '<div class="spinner-border text-white spinner-border-sm" role="status"></div>'
var submitCollection = false;
var imageIsUploading = false;

AOS.init();

$(window).load(function () {
  var navbarHeight = $('.header-container').outerHeight()
  $('.landing-page').css(`margin-top`, `${navbarHeight}px`)
})

$(document).ready(function () {
  var navbarHeight = $('.header-container').outerHeight()

  // var windowHeight = window.innerHeight
  // $('.category-item').css('height', `${(windowHeight - navbarHeight) / 1}px`)
  // $('.category-item .unused-col').css('height', `${(windowHeight - navbarHeight) / 1}px`)

  
  $('.category-item').css('height', `400px`)
  $('.category-item .unused-col').css('height', `400px`)

  $('.scroll').on('click', function (e) {
    const href = $(this).attr(`href`)
    $('html, body').animate({
      scrollTop: `${$(href).offset().top - navbarHeight + 2}px`
    }, 400);
  })

  $('body').find('[open-modal]').each(function () {
    $(this).on('click', function () {
      const type = $(this).attr('data-type')
      const id = $(this).attr('data-id')
      const modalTarget = $(this).attr('data-target')
      const job = $(this).attr('data-job')
      const titleColor = $(this).attr('data-title-color')

      if (job === 'get-detail') {
        getDetailByParameter(type, id, modalTarget, titleColor)
      }

      if (job === 'get-by-product-category') {
        getProductListByCategoryId(id, modalTarget, titleColor)
      }

      $(`#${modalTarget}`).modal('show');
    })
  })

  $('.modal').on('hidden.bs.modal', function (e) {
    $(this).find('.modal-content').html('')
  })

  $('.modal').on('shown.bs.modal', function (e) {
    initScrollBar()
    $('body, .header-container').css('padding-right', `0px`);
  })

  initScrollBar()

  $('body').on('click', '.modal-next-page-container', function () {
    const id = $(this).attr('data-id')
    const target = 'main-modal'
    if (id) {
      getDetailByParameter('page', id, target)
    }
  })

  $('body').on('click', '.btn-close-modal', function () {
    $('.modal').modal('hide');
  })

  $('.slider-container').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    appendDots: $('.dots-container'),
    nextArrow: $('.slider-right'),
    prevArrow: $('.slider-left')
  })

  $('body').on('click', '.add-more-item', function () {
    var count = $('.item-container .item-category').length
    if (count < 5) {
      var clone = $('.item-category-clone .item-category').clone();
      $('.item-container').append(clone)
    }
    $('.remove-product').removeClass('hidden')
  })

  $('body').on('click', '.avatar-take-image-button', function () {
    $('[name="file_avatar"]').click();
  })

  $('body').on('change', '[name="file_avatar"]', function (e) {
    const files = e.target.files[0]
    const url = URL.createObjectURL(files)
    $('.avatar-container-image').css('background-image', `url(${url})`)
  })

  $('body').on('click', '.socmed-item-feed .read-more', function () {
    const current_text = $(this).text()
    const new_text = current_text === 'Read More' ? 'Show Less' : 'Read More'
    $(this).parent().find('.message-container').toggleClass('hide')
    $(this).text(new_text)
  })

  $('body').find('[get-social-feed]').each(function () {
    const type = $(this).attr('data-type')
    const container = $(this)
    let action = ''
    if (type === 'fb') {
      action = 'generate_fb_feed_page'
    }

    if (type === 'insta') {
      action = 'generate_instagram_feed'
    }

    if (action) {
      $.ajax({
        method: 'GET',
        url: myAjax.ajaxUrl,
        data: {
          action
        },
        error: function (e) {
          console.log('error', e)
        },
        success: function (e) {
          $(container).html(e)
        }
      })
    }
  })

  $('body').on('change', '[name="_prod_cat[]"]', function () {
    const parent = $(this).parent().parent().find('[name="_product_id[]"]')
    const val = $(this).val()
    console.log(parent, val)
    if (val) {
      $.ajax({
        method: 'GET',
        url: myAjax.ajaxUrl,
        data: {
          action: 'get_product_by_category_id',
          category_id: val
        },
        error: function (e) {
          console.log('error', e)
        },
        success: function (e) {
          let data = null;
          if (e) data = JSON.parse(e)
          let element = '<option value="">-- Select Product --</option>'
          Object.keys(data).forEach(function (v) {
            element += `<option value="${v}">${data[v]}</option>`
          })
          parent.html(element)
        }
      })
    }
  })

  $('body').on('click', '.remove-product', function () {
    const item = $('.item-container .item-category')
    const this_item = $(this)
    if (item.length > 0) {
      item.eq(item.length - 1).remove()
      if (item.length === 2) this_item.addClass('hidden')
    }
  })

  $('body').on('click', '.btn-read-more-product-item', function () {
    let parent = $(this).parent()
    parent.hide()
    parent.parent().addClass('expand')
    parent.parent().find('.expand-item').show()
  });
  $('body').on('click', '.btn-read-less-product-item', function () {
    let parent = $(this).parent()
    parent.hide()
    parent.parent().removeClass('expand')
    parent.parent().find('.unexpand-item').show()
  });

  $('.navbar-nav>li>a').on('click', function(){
    $('.navbar-collapse').collapse('hide');
  });
})

function initScrollBar() {
  $('body').find('.scrollbar-rail').each(function () {
    $(this).scrollbar();
  })
}


function getDetailByParameter(type, id, modalTarget, titleColor) {
  const data = {
    action: 'get_detail',
    type,
    id,
    titleColor
  }

  $.ajax({
    method: 'GET',
    url: myAjax.ajaxUrl,
    data,
    error: function (e) {
      console.log('error', e)
    },
    success: function (e) {
      $(`#${modalTarget}`).find('.modal-content').html(e)
    }
  })
}

function getProductListByCategoryId(id, modalTarget, titleColor) {
  const data = {
    action: 'get_product_list_by_category_id',
    id,
    titleColor
  }

  $.ajax({
    method: 'GET',
    url: myAjax.ajaxUrl,
    data,
    error: function (e) {
      console.log('error', e)
    },
    success: function (e) {
      $(`#${modalTarget}`).find('.modal-content').html(e)
    }
  })
}

