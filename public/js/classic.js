let currentRow = 1;
let currentCol = 0;
let tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
tomorrow.setHours(0, 0, 1);
tomorrow = encodeURIComponent(tomorrow);

let data = {
    status: null,
    guesses: [],
    tries: currentRow,
};



function getNextInput(row, col) {
    const inputs = document.querySelectorAll(`.js-try-${row}`);
    return inputs[col - 1] || null;
}



async function updateKeyboard(keyboard) {
    console.log(keyboard);

    Object.entries(keyboard).forEach(([key, stat]) => {
        const letter = document.querySelector('.js-key[data-key="' + key + '"]');
        if (letter) {
            if (stat !== "default") {
                letter.classList.add(stat);
            }
        }
    });
}



async function checkGuess() {

    let guess = '';
    for (let i = 1; i <= 5; i++) {
        guess += getNextInput(currentRow, i).value.toLowerCase();
    }

    if (guess.length !== 5) {
        return;
    } else if (currentRow === 6) {

        fetch('/api/set-cookie/wordle_status/' + encodeURIComponent(JSON.stringify(data)));

        alert(`Game Over!`);

        data.status = 'lose';

        // await sleep(1000);
        window.location.reload();

        return;

    }

    const json = await fetch('/api/check-guess/' + guess);
    const response = await json.json();

    if (response.result == "win") {

        fetch('/api/set-cookie/wordle_status/' + encodeURIComponent(JSON.stringify(data)));

        alert("Congratulations! You've guessed the word!");

        data.status = 'win';

        // await sleep(1000);
        window.location.reload();

        return;

    } else if (response.result == "lose") {

        fetch('/api/set-cookie/wordle_status/' + encodeURIComponent(JSON.stringify(data)));

        alert("Game Over! You've run out of tries!");

        data.status = 'lose';

        // await sleep(1000);
        window.location.reload();

        return;

    } else if (response.result == "valid") {

        data.status = 'playing';
        data.guesses.push(guess);

        fetch('/api/set-cookie/wordle_status/' + encodeURIComponent(JSON.stringify(data)));

        for (let i = 0; i < 5; i++) {
            let letterInput = getNextInput(currentRow, i + 1);
            let letter = guess[i];

            Object.entries(response.keyboard).forEach(([key, stat]) => {
                if (letter) {
                    if (stat !== "default" && key === letter) {
                        letterInput.classList.add(stat);
                    }
                }
            });
        }

        updateKeyboard(response.keyboard);

        currentRow++;
        currentCol = 0;
        focusNextInput();

    } else if (response.result == "invalid") {

        alert(response.message);

    }
}



function focusNextInput() {
    document.querySelectorAll('.js-game-inputs input').forEach(input => {
        input.classList.remove('active');
    });
    let nextInput = getNextInput(currentRow, currentCol + 1);
    if (nextInput) {
        nextInput.focus();
        nextInput.classList.add('active');
    }
}



function handleKeyPress(event) {
    if (event.key >= 'a' && event.key <= 'z' && currentCol < 5) {
        let input = getNextInput(currentRow, currentCol + 1);
        if (input) {
            input.value = event.key.toUpperCase();
            currentCol++;
            if (currentCol < 5) {
                focusNextInput();
            }
        }
    } else if (event.key === 'Backspace' && currentCol > 0) {
        currentCol--;
        let prevInput = getNextInput(currentRow, currentCol + 1);
        if (prevInput) {
            prevInput.value = '';
            focusNextInput();
        }
    } else if (event.key === 'Enter' && currentCol === 5) {
        checkGuess();
    }
}



function handleKeyboard(key) {
    if (key >= 'a' && key <= 'z' && currentCol < 5) {
        let input = getNextInput(currentRow, currentCol + 1);
        if (input) {
            input.value = key.toUpperCase();
            currentCol++;
            if (currentCol < 5) {
                focusNextInput();
            } else {
                checkGuess();
            }
        }
    } else if(key === '<' && currentCol > 0) {
        currentCol--;
        let prevInput = getNextInput(currentRow, currentCol + 1);
        if (prevInput) {
            prevInput.value = '';
            focusNextInput();
        }
    } else if(key === '>' && currentCol === 5) {
        if (currentCol === 5) {
            checkGuess();
        }
    }
}



function continueGame(guesses, tries) {
    currentRow = tries;

    guesses.forEach((guess, i) => {
        for (let j = 0; j < 5; j++) {
            getNextInput(i + 1, j + 1).value = guess[j].toUpperCase();
        }
        checkGuess();
    });

    focusNextInput();

}





document.addEventListener("DOMContentLoaded", async function() {

    const json = await fetch('/api/get-cookie/wordle_status/');
    const response = await json.json();

    if (response.status == "playing") {
        continueGame(response.guesses, response.tries);
    }

    if(response.status != 'win' && response.status != 'lose') {
        document.addEventListener('keydown', handleKeyPress);

        keys = document.querySelectorAll('.js-keyboard button[data-key]');
        keys.forEach(key => {
            key.addEventListener('click', function() {
                handleKeyboard(key.dataset.key);
            });
        });
    }

    focusNextInput(); // Focus the first input on page load
});
