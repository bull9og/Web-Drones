window.addEventListener('scroll', function() {
    var scrollPosition = window.scrollY; 
    var text = document.querySelector('.sectionThree_text'); 
    var textColor = getColorFromScrollPosition(scrollPosition); 
    text.style.color = textColor; 
  });


  function getColorFromScrollPosition(scrollPosition) {
    var maxScroll = document.documentElement.scrollHeight - window.innerHeight; 
    var percentage = (scrollPosition / maxScroll) * 100; 
  
    if (percentage < 20) {
      return '#363636';
    } else {
      return '#fff';
    }
  }