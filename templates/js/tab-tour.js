const tab_header = document.querySelector(".tab-header"),
  tab_content = document.querySelector(".tab-content");

function tabClicked(element) {
  let activedElement = tab_header.querySelector(".active");
  let activeTab = tab_content.querySelector(".active");
  let elementName = element.getAttribute("name");
  let displayTab = tab_content.querySelector(`#${elementName}`);

  activedElement.classList.remove("active");
  activeTab.classList.remove("active");
  element.classList.add("active");
  displayTab.classList.add("active");
}


