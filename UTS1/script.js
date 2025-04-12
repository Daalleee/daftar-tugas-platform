document.getElementById("submitBtn").addEventListener("click", function () {
  const firstName = document.getElementById("firstName").value.trim();
  const lastName = document.getElementById("lastName").value.trim();
  const email = document.getElementById("email").value.trim();
  const numHobbies = document.getElementById("numHobbies").value;

  // Validasi input
  if (!firstName) {
    alert("Harap masukkan nama depan.");
    return;
  }
  if (!lastName) {
    alert("Harap masukkan nama belakang.");
    return;
  }
  if (!email || !email.includes("@")) {
    alert("Harap masukkan email yang valid.");
    return;
  }
  if (!numHobbies || isNaN(numHobbies) || numHobbies < 1 || numHobbies > 5) {
    alert("Jumlah hobi harus antara 1 dan 5.");
    return;
  }

  // Nonaktifkan form awal
  document.getElementById("submitBtn").disabled = true;
  document.getElementById("submitBtn").style.display = "none";
  document.getElementById("firstName").disabled = true;
  document.getElementById("lastName").disabled = true;
  document.getElementById("email").disabled = true;
  document.getElementById("numHobbies").disabled = true;

  // Buat input untuk hobi
  let hobbyInputs = "<h3 class='text-center mb-3'>Masukkan Hobi:</h3>";
  for (let i = 1; i <= numHobbies; i++) {
    hobbyInputs += `
      <div class="mb-3">
        <label for="hobby${i}" class="form-label">Hobi ${i}:</label>
        <input type="text" id="hobby${i}" class="form-control" placeholder="Masukkan hobi ${i}" required>
      </div>`;
  }
  hobbyInputs +=
    '<div class="d-flex justify-content-center"><button type="button" id="submitHobbiesBtn" class="btn btn-primary">Oke</button></div>';
  document.getElementById("hobbyInputs").innerHTML = hobbyInputs;
  document.getElementById("hobbyInputs").classList.remove("hidden");

  // Event listener untuk submit hobi
  document
    .getElementById("submitHobbiesBtn")
    .addEventListener("click", function () {
      let hobbies = [];
      for (let i = 1; i <= numHobbies; i++) {
        const hobby = document.getElementById(`hobby${i}`).value.trim();
        if (!hobby) {
          alert(`Harap masukkan hobi untuk Hobi ${i}.`);
          return;
        }
        hobbies.push(hobby);
      }

      // Nonaktifkan input hobi
      document.getElementById("submitHobbiesBtn").disabled = true;
      document.getElementById("submitHobbiesBtn").style.display = "none";
      for (let i = 1; i <= numHobbies; i++) {
        document.getElementById(`hobby${i}`).disabled = true;
      }

      // Tampilkan checkbox untuk pilihan hobi
      let finalHTML = `<h3 class="text-center mb-3">Pilih Hobi Favorit:</h3>`;
      hobbies.forEach((hobby, index) => {
        finalHTML += `
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="hobbyCheck${index}" value="${hobby}">
          <label class="form-check-label" for="hobbyCheck${index}">${hobby}</label>
        </div>`;
      });
      finalHTML +=
        '<div class="d-flex justify-content-center mt-3"><button type="button" id="showResultBtn" class="btn btn-primary">Oke</button></div>';
      document.getElementById("finalHobbies").innerHTML = finalHTML;
      document.getElementById("finalHobbies").classList.remove("hidden");

      // Event listener untuk menampilkan hasil
      document
        .getElementById("showResultBtn")
        .addEventListener("click", function () {
          const selectedHobbies = document.querySelectorAll(
            'input[type="checkbox"]:checked'
          );
          if (selectedHobbies.length === 0) {
            alert("Harap pilih setidaknya satu hobi.");
            return;
          }

          const selectedHobbyValues = Array.from(selectedHobbies).map(
            (hobby) => hobby.value
          );
          const result = `Hallo, nama saya ${firstName} ${lastName}, dengan email ${email}, saya mempunyai sejumlah ${numHobbies} pilihan hobi yaitu ${hobbies.join(
            ", "
          )}, dan saya menyukai ${selectedHobbyValues.join(", ")}.`;
          alert(result);

          // Nonaktifkan tombol
          document.getElementById("showResultBtn").disabled = true;
          document.getElementById("showResultBtn").style.display = "none";
        });
    });
});

// Inisialisasi tooltip Bootstrap
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
