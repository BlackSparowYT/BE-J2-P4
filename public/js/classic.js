const getTodaysWordleWord = async () => {
    const url = 'https://wordle-game-api1.p.rapidapi.com/word';
    const options = {
        method: 'POST',
        headers: {
            'content-type': 'application/json',
            'X-RapidAPI-Key': 'c270ff25bbmshfdb1e857975e48ap137282jsna1c2b008976b',
            'X-RapidAPI-Host': 'wordle-game-api1.p.rapidapi.com'
        },
        body: {
            timezone: 'UTC + 0'
        }
    };

    try {
        const response = await fetch(url, options);
        const result = await response.text();
        console.log(result);
    } catch (error) {
        console.error(error);
    }
};

getTodaysWordleWord();
