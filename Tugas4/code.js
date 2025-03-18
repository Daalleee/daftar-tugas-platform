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
        });
    });
});
