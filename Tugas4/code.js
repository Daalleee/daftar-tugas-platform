document.getElementById("submitBtn").addEventListener("click", function () {
  const name = document.getElementById("name").value;
  const numChoices = document.getElementById("numChoices").value;

  if (!name) {
    alert("Harap masukkan nama.");
    return;
  }

  if (!numChoices || isNaN(numChoices) || numChoices < 1 || numChoices > 5) {
    alert("Pilihan maksimal 5");
    return;
  }

  document.getElementById("submitBtn").disabled = true;
  document.getElementById("submitBtn").style.display = "none";
  document.getElementById("name").disabled = true;
  document.getElementById("numChoices").disabled = true;

  let choiceInputs = "<h3>Masukkan Pilihan:</h3>";
  for (let i = 1; i <= numChoices; i++) {
    choiceInputs += `
            <div class="choice-container">
                <label>Pilihan ${i}:</label>
                <input type="text" id="choice${i}" placeholder="Teks Pilihan ${i}">
            </div>`;
  }

  choiceInputs +=
    '<input type="button" value="Submit Pilihan" id="submitChoicesBtn">';
  document.getElementById("choiceInputs").innerHTML = choiceInputs;
  document.getElementById("choiceInputs").classList.remove("hidden");

  document
    .getElementById("submitChoicesBtn")
    .addEventListener("click", function () {
      let choices = [];
      for (let i = 1; i <= numChoices; i++) {
        const choice = document.getElementById(`choice${i}`).value;
        if (!choice) {
          alert(`Harap masukkan semua pilihan untuk Pilihan ${i}.`);
          return;
        }
        choices.push(choice);
      }

      document.getElementById("submitChoicesBtn").disabled = true;
      document.getElementById("submitChoicesBtn").style.display = "none";
      for (let i = 1; i <= numChoices; i++) {
        document.getElementById(`choice${i}`).disabled = true;
      }

      let finalHTML = `<h3>Pilihan:</h3>`;
      choices.forEach((choice, index) => {
        finalHTML += `
                <input type="radio" name="finalChoice" id="finalChoice${index}" value="${choice}">
                <label for="finalChoice${index}">${choice}</label><br>`;
      });

      finalHTML +=
        '<input type="button" value="Tampilkan Hasil" id="showResultBtn">';
      document.getElementById("finalChoice").innerHTML = finalHTML;
      document.getElementById("finalChoice").classList.remove("hidden");

      document
        .getElementById("showResultBtn")
        .addEventListener("click", function () {
          const selectedChoice = document.querySelector(
            'input[name="finalChoice"]:checked'
          );
          if (!selectedChoice) {
            alert("Harap pilih salah satu pilihan.");
            return;
          }
          const result = `Hallo, nama saya ${name}, saya mempunyai sejumlah ${numChoices} pilihan yaitu ${choices.join(
            ", "
          )}, dan saya memilih ${selectedChoice.value}.`;
          alert(result);

          document.getElementById("showResultBtn").disabled = true;
          document.getElementById("showResultBtn").style.display = "none";
        });
    });
});
