function Parser(str, name) {
  if (str.length == 0) {
    document.getElementById("htmltext_" + name).innerHTML = "";
    return;
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200)
        document.getElementById("htmltext_" + name).innerHTML =
          xmlhttp.responseText;
    };
    xmlhttp.open("POST", "parser.php", true);
    xmlhttp.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    if (name === "title") str = "##" + str;
    xmlhttp.send("text=" + str);
  }
}
