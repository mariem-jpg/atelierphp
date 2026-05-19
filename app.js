const express = require('express');
const app = express();

app.get('/', (req, res) => {
    res.send('Heello rouuaa!');
});

app.listen(3001, () => {
    console.log('Server sur port 3001');
});
