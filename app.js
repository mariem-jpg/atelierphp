const express = require('express');
const app = express();

app.get('/', (req, res) => {
    res.send('Heelllooooo yosrrrrr');
});

app.listen(3001, () => {
    console.log('Server sur port 3001');
});
