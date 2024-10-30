/** to get cookie value */
function mail_getcookie(name) {
  var cookie_name = name + "=";
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var extracted_cookie = cookies[i];
    while (extracted_cookie.charAt(0) == " ")
      extracted_cookie = extracted_cookie.substring(1, extracted_cookie.length);
    if (extracted_cookie.indexOf(cookie_name) == 0)
      return extracted_cookie.substring(
        cookie_name.length,
        extracted_cookie.length
      );
  }
  return null;
}

jQuery(document).ready(function ($) {
  var mail_id = 0;
  jQuery("a").each(function (idx) {
    if (
      jQuery(this).attr("href") == "admin.php?page=mail/classes/class.mailplugin_mail.php"
    ) {
      if (mail_id == 1) {
        jQuery(this).css("display", "none");
      }
      mail_id++;
    }
  });
  /** to show other apps  **/
  var id1 = 0;
  jQuery("a").each(function (idx) {
    if (
      jQuery(this).attr("href") == "admin.php?page=Other"
    ) {
      jQuery(this).addClass("show_popup_mail");
      jQuery(this).attr("href", "#");
      jQuery(this).attr("id", "show_popup_mail");
      id1++;
    }
  });
  /** to close other apps  **/
  var modal = document.getElementById("mailModal");
  var btn = document.getElementById("show_popup_mail");
  //var span = document.getElementsByClassName("mail_close")[0];
  var span = document.getElementsByClassName("mail_close")[0];
  btn.onclick = function () {
    modal.style.display = "block";
  }
  span.onclick = function () {
    modal.style.display = "none";
  }
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});