const express = require('express');
const app = express();

app.get('/', (req, res) => {
    res.send('bonsoir yosr');
});

app.listen(3001, () => {
    console.log('Server sur port 3001');
});
