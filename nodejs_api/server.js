require('dotenv').config();
const express = require('express');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json()); // Permet de lire les requêtes en JSON

const PORT = process.env.PORT || 3000;

const usersRoutes = require('./routes/users');
app.use('/users', usersRoutes);

app.get('/', (req, res) => {
    res.send('API Node.js en cours de migration !');
});

app.listen(PORT, () => {
    console.log(`🚀 Serveur Node.js lancé sur http://localhost:${PORT}`);
});
