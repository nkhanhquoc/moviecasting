function shareFB(link) {
  if(link == undefined || link == ""){
      link = window.location.href;
  }
  window.location.href = 'https://facebook.com/sharer.php?u='+link;
}
