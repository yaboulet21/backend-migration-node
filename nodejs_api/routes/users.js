const express = require('express');
const router = express.Router();
const pool = require('../db'); // Connexion à la BDD

// GET /users - Récupérer tous les utilisateurs
router.get('/', async (req, res) => {
    try {
        const [users] = await pool.query("SELECT * FROM users");
        res.json(users);
    } catch (error) {
        res.status(500).json({ error: "Erreur lors de la récupération des utilisateurs" });
    }
});

// POST /users - Ajouter un utilisateur
router.post('/', async (req, res) => {
    const { name, email } = req.body;
    if (!name || !email) {
        return res.status(400).json({ error: "Les champs name et email sont requis" });
    }

    try {
        const [result] = await pool.query("INSERT INTO users (name, email) VALUES (?, ?)", [name, email]);
        res.json({ message: "Utilisateur ajouté avec succès", userId: result.insertId });
    } catch (error) {
        res.status(500).json({ error: "Erreur lors de l'ajout de l'utilisateur" });
    }
});

// PUT /users/:id - Mettre à jour un utilisateur
router.put('/:id', async (req, res) => {
    const { name, email } = req.body;
    const { id } = req.params;

    if (!name || !email) {
        return res.status(400).json({ error: "Les champs name et email sont requis" });
    }

    try {
        const [result] = await pool.query("UPDATE users SET name = ?, email = ? WHERE id = ?", [name, email, id]);
        if (result.affectedRows > 0) {
            res.json({ message: "Utilisateur mis à jour avec succès" });
        } else {
            res.status(404).json({ error: "Utilisateur non trouvé" });
        }
    } catch (error) {
        res.status(500).json({ error: "Erreur lors de la mise à jour de l'utilisateur" });
    }
});

// DELETE /users/:id - Supprimer un utilisateur
router.delete('/:id', async (req, res) => {
    const { id } = req.params;

    try {
        const [result] = await pool.query("DELETE FROM users WHERE id = ?", [id]);
        if (result.affectedRows > 0) {
            res.json({ message: "Utilisateur supprimé avec succès" });
        } else {
            res.status(404).json({ error: "Utilisateur non trouvé" });
        }
    } catch (error) {
        res.status(500).json({ error: "Erreur lors de la suppression de l'utilisateur" });
    }
});

module.exports = router;
