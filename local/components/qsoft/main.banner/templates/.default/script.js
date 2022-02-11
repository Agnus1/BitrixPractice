$(function () {

  $('[data-slick-carousel]').slick({
    dots: true,
  });

  $('[data-accordion]').each(function () {
    let $accordion = $(this);
    let isOpen = $accordion.data('active') !== undefined;
    
    let $accordionToggle = $accordion.find('[data-accordion-toggle]');
    let $accordionNoActiveItem = $accordion.find('[data-accordion-not-active]');
    let $accordionActiveItem = $accordion.find('[data-accordion-active]');
    let $accordionContent = $accordion.find('[data-accordion-details]');
    
    $accordionToggle.on('click', function () {
      if (isOpen) {
        $accordionNoActiveItem.show();
        $accordionActiveItem.hide();
        $accordionContent.slideUp();
      } else {
        $accordionNoActiveItem.hide();
        $accordionActiveItem.show();
        $accordionContent.slideDown();
      }
      
      isOpen = !isOpen;
    })
  })
})
