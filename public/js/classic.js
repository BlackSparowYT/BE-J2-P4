document.addEventListener("DOMContentLoaded", function() {
    let currentRow = 1;
    let currentCol = 0;
    let tomorrow = new Date();
    let word = fetchDailyWord();
    tomorrow.setDate(tomorrow.getDate() + 1);
    tomorrow.setHours(0, 0, 1, 0);

    function getNextInput(row, col) {
        const inputs = document.querySelectorAll(`.js-try-${row}`);
        return inputs[col - 1] || null;
    }

    async function fetchWordnikApiKey() {
        try {
            const response = await fetch('/api/wordnik-api-key');
            const data = await response.json();
            apiKey = data.wordnik_api_key;
            if (!apiKey) {
                return null;
            }
            return apiKey;
        } catch (error) {
            return null;
        }
    }

    async function fetchDailyWord() {
        try {
            const response = await fetch('/api/wordle-word');
            const data = await response.json();
            word = data.word;
            if (!word) {
                return null;
            }
            return word;
        } catch (error) {
            return null;
        }
    }

    async function checkIfValid(word) {
        const apiKey = await fetchWordnikApiKey(); // Replace with your Wordnik API key
        const apiUrl = `https://api.wordnik.com/v4/word.json/${word}/definitions?api_key=${apiKey}`;

        try {
            const response = await fetch(apiUrl);
            const definitions = await response.json();

            let validWord = false;

            definitions.forEach(definition => {
                if(definition.text != "" && definition.text != null && definition.text != undefined) {
                    validWord = true;
                    return;
                }
            });

            return validWord;
        } catch (error) {
            return false;
        }
    }

    async function checkGuess() {
        let guess = '';
        for (let i = 1; i <= 5; i++) {
            guess += getNextInput(currentRow, i).value.toLowerCase();
        }

        if (guess.length !== 5) return;

        if (guess === word) {
            alert("Congratulations! You've guessed the word!");
            let data = {
                status: 'win',
                word: word,
                tries: currentRow,
            };
            data = JSON.stringify(data);
            document.cookie = `wordle_status=${data}; expires=${tomorrow}; path=/`;
            window.location.reload();

            return;
        }

        const validGuess = await checkIfValid(guess);



        if (validGuess) {
            for (let i = 0; i < 5; i++) {
                let letterInput = getNextInput(currentRow, i + 1);
                let letter = guess[i];

                if (word[i] === letter) {
                    letterInput.classList.add('correct');
                } else if (word.includes(letter)) {
                    letterInput.classList.add('present');
                } else {
                    letterInput.classList.add('absent');
                }
            }

            if (currentRow === 6) {
                alert(`Game Over! The correct word was: ${word}`);
            } else {
                currentRow++;
                currentCol = 0;
                focusNextInput();
            }
        } else {
            alert("Invalid word! Please enter a valid 5-letter word.");
        }
    }

    function focusNextInput() {
        document.querySelectorAll('.game input').forEach(input => {
            input.classList.remove('active');
        });
        let nextInput = getNextInput(currentRow, currentCol + 1);
        if (nextInput) {
            nextInput.focus();
            nextInput.classList.add('active');
        }
    }

    function handleKeyPress(event) {
        if(vlx_get_cookie_val('wordle_status') != 'win') {
            if (event.key >= 'a' && event.key <= 'z' && currentCol < 5) {
                let input = getNextInput(currentRow, currentCol + 1);
                if (input) {
                    input.value = event.key.toLowerCase();
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
    }

    document.addEventListener('keydown', handleKeyPress);

    focusNextInput(); // Focus the first input on page load
});
