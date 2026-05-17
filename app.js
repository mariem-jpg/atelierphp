const express = require('express');
const app = express();

app.get('/', (req, res) => {
    res.send('c est trop walah');
});

app.listen(3001, () => {
    console.log('Server sur port 3001');
});"// Test auto-deploiement $(date)" 
