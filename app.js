const express = require('express');
const app = express();

app.get('/', (req, res) => {
    res.send('dhia salem');
});

app.listen(3001, () => {
    console.log('Server sur port 3001');
});
