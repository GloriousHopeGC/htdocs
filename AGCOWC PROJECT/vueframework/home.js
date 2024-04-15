function scrollToSection(sectionId) {
    if (sectionId) {
      const section = document.getElementById(sectionId);
      if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
        return;
      }
    }
  
    // If sectionId is not provided or the section is not found, scroll to the top of the page
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
  
  // Vue.js instance to handle scrolling
  new Vue({
    el: '#navbar-brandhome'
  });
  