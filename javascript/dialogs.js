let dialog1 = document.getElementById("dialog1");


function openDialog(value) {
  switch (value) {
    case "Delete Account":
      dialog1 = document.getElementById("dialog1");
      console.log(dialog1);
      if (dialog1 != null) dialog1.style.display = "block";
      break;
  }
}

function closeDialog(value) {
  switch (value) {
    case "Delete Account":
      dialog1 = document.getElementById("dialog1");
      if (dialog1 != null) dialog1.style.display = "none";
      break;
    
  }
}

