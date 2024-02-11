// JavaScript untuk membuka dan menutup modal popup
var modal = document.getElementById("myModal");

function openModal() {
  modal.style.display = "block";
}

function openModalReminder(ketDetail) {
  var ketDetailInput = document.getElementById("ketDetail");
  ketDetailInput.innerText = ketDetail;
  modal.style.display = "block";
}

function openModalSparepart(idSparepart, namaSparepart, jumlahSparepart) {
  var sparepartIdInput = document.getElementById("sparepartId");
  var sparepartNamaInput = document.getElementById("sparepartNama");
  var sparepartStokInput = document.getElementById("sparepartStok");
  sparepartIdInput.value = idSparepart;
  sparepartNamaInput.value = namaSparepart;
  sparepartStokInput.value = jumlahSparepart;
  modal.style.display = "block";
}

function openModalRecordSparepart(ketTindakan) {
  var ketTindakanInput = document.getElementById("keteranganTindakan");
  ketTindakanInput.innerText = ketTindakan;
  modal.style.display = "block";
}

function openModalMesin(idMesin, namaMesin, idStatusOld) {
  var mesinIdInput = document.getElementById("mesinId");
  var mesinNamaInput = document.getElementById("mesinNama");
  var statusIdOldInput = document.getElementById("statusIdOld");
  mesinIdInput.value = idMesin;
  mesinNamaInput.value = namaMesin;
  statusIdOldInput.value = idStatusOld;
  modal.style.display = "block";
}

function openModalAkun(idAkun, idRuleAkun) {
  var akunIdInput = document.getElementById("akunId");
  var ruleIdInput = document.getElementById("ruleId");
  akunIdInput.value = idAkun;
  ruleIdInput.value = idRuleAkun;
  modal.style.display = "block";
}

function openModalEditAkun(
  idAkun,
  idRuleAkun,
  namaAkun,
  emailAkun,
  usernameAkun,
  teleponAkun,
  genderAkun
) {
  var akunIdInput = document.getElementById("akunId");
  var ruleSelectInput = document.getElementById("ruleSelect");
  var akunNamaInput = document.getElementById("akunNama");
  var akunEmailInput = document.getElementById("akunEmail");
  var akunUsernameInput = document.getElementById("akunUsername");
  var akunTeleponInput = document.getElementById("akunTelepon");
  var genderSelectInput = document.getElementById("genderSelect");
  akunIdInput.value = idAkun;
  akunNamaInput.value = namaAkun;
  akunEmailInput.value = emailAkun;
  akunUsernameInput.value = usernameAkun;
  akunTeleponInput.value = teleponAkun;

  // Loop melalui opsi di dalam select box "ruleSelect" untuk mencocokkan dengan idRuleAkun
  if (idRuleAkun != 7) {
    for (var i = 0; i < ruleSelectInput.options.length; i++) {
      if (ruleSelectInput.options[i].value == idRuleAkun) {
        // Jika idRuleAkun cocok, atur opsi ini sebagai opsi yang dipilih
        ruleSelectInput.selectedIndex = i;
        break; // Keluar dari loop setelah opsi dipilih
      }
    }
  }

  for (var i = 0; i < ruleSelectInput.options.length; i++) {
    if (ruleSelectInput.options[i].value == idRuleAkun) {
      // Jika idRuleAkun cocok, atur opsi ini sebagai opsi yang dipilih
      ruleSelectInput.selectedIndex = i;
      break; // Keluar dari loop setelah opsi dipilih
    }
  }
  if (genderAkun === "Laki - laki") {
    genderSelectInput.value = "Laki - laki";
  } else if (genderAkun === "Perempuan") {
    genderSelectInput.value = "Perempuan";
  }

  modal.style.display = "block";
}

function closeModal() {
  modal.style.display = "none";
}

// Function to hide the option with value "0"
function hideOptionZero(selectElement) {
  var selectedValue = selectElement.value;

  var optionZero = selectElement.querySelector('option[value="0"]');
  var optionSelected = selectElement.querySelector(
    'option[value="' + selectedValue + '"]'
  );

  if (optionZero && optionSelected) {
    optionZero.style.display = "none";
  }
}

function validateForm(idSelect, messageWrong) {
  var selectElement = document.getElementById(idSelect);
  if (selectElement.value === "0") {
    alert("Pilih " + messageWrong + " terlebih dahulu.");
    return false; // Menghentikan form submit jika opsi bernilai 0
  }
  return true; // Lanjutkan submit jika opsi bukan 0
}
