const pool = require('./db');

async function testConnection() {
    try {
        const [rows] = await pool.query("SELECT 1 + 1 AS result");
        console.log("Connexion réussie à MariaDB ! Résultat :", rows[0].result);
    } catch (error) {
        console.error("Erreur de connexion à la base de données :", error);
    } finally {
        process.exit();
    }
}

testConnection();
