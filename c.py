import os
import chardet  # Bibliothèque pour la détection de l'encodage

# Répertoire où vous souhaitez exécuter le script
repertoire_courant = "./"

# Nom du fichier de sortie
nom_fichier_sortie = "structure_repertoire.md"

# Liste des sous-répertoires à ne pas prendre en compte
sous_repertoires_a_exclure = ["./temp", "./public", "./app"]

# Fonction pour déterminer l'encodage d'un fichier
def detecter_encodage(chemin_fichier):
    with open(chemin_fichier, 'rb') as fichier_binaire:
        resultat = chardet.detect(fichier_binaire.read())
    return resultat['encoding']

# Fonction pour parcourir le répertoire et ses sous-répertoires
def parcourir_repertoire(repertoire):
    contenu = ""
    for dossier, sous_dossiers, fichiers in os.walk(repertoire):
        if os.path.basename(dossier) not in sous_repertoires_a_exclure:
            contenu += f"Dossier: {dossier}\n"
            for fichier in fichiers:
                chemin_fichier = os.path.join(dossier, fichier)
                encodage = detecter_encodage(chemin_fichier)
                try:
                    with open(chemin_fichier, 'r', encoding=encodage) as fichier_ouvert:
                        contenu += f"Fichier: {chemin_fichier}\n"
                        contenu += fichier_ouvert.read() + "\n\n"
                except UnicodeDecodeError:
                    contenu += f"Erreur de décodage pour le fichier: {chemin_fichier}\n\n"
    return contenu

# Appel de la fonction pour parcourir le répertoire
contenu_repertoire = parcourir_repertoire(repertoire_courant)

# Écriture du contenu dans le fichier de sortie
with open(nom_fichier_sortie, 'w', encoding='utf-8') as fichier_sortie:
    fichier_sortie.write(contenu_repertoire)

print(f"Le fichier '{nom_fichier_sortie}' a été créé avec succès.")
