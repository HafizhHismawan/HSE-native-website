function clearRadioSelection(groupName) {
  var radioButtons = document.getElementsByName(groupName);
  for (var i = 0; i < radioButtons.length; i++) {
    radioButtons[i].checked = false;
  }
}
function validateForm() {
  var selectElement = document.getElementById("id-mesin");
  if (selectElement.value === "0") {
    alert("Pilih nomer seri mesin terlebih dahulu.");
    return false; // Menghentikan form submit jika opsi bernilai 0
  }
  return true; // Lanjutkan submit jika opsi bukan 0
}
