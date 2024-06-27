import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import StandardScaler, OneHotEncoder
from sklearn.compose import ColumnTransformer
from sklearn.pipeline import Pipeline
import joblib

# Charger les données
data = pd.read_csv('startup_db_EDA.csv')

# Sélectionner les features et la cible pour le modèle de succès
features = ['categorie', 'pays', 'ouverture', 'fermeture', 'nombre_de_fondateur', 
            'nombre_d_employe', 'founding_round', 'Total_funding', 'Profit', 'nombre_d_investisseur']
target_success = 'resultat'
target_reason = 'raison'

# Séparer les features et la cible
X = data[features]
y_success = data[target_success]
y_reason = data[target_reason]

# Remplacer les valeurs manquantes par la médiane pour les colonnes numériques
for col in ['fermeture', 'nombre_d_employe', 'Total_funding', 'Profit', 'nombre_d_investisseur']:
    X[col].fillna(X[col].median(), inplace=True)

# Remplacer les valeurs manquantes pour les colonnes catégorielles par le mode
for col in ['categorie', 'pays']:
    X[col].fillna(X[col].mode()[0], inplace=True)

# Définir les transformations pour les colonnes numériques et catégorielles
numeric_features = ['ouverture', 'fermeture', 'nombre_de_fondateur', 'nombre_d_employe', 
                    'founding_round', 'Total_funding', 'Profit', 'nombre_d_investisseur']
categorical_features = ['categorie', 'pays']

numeric_transformer = Pipeline(steps=[
    ('scaler', StandardScaler())])

categorical_transformer = Pipeline(steps=[
    ('encoder', OneHotEncoder(handle_unknown='ignore'))])

preprocessor = ColumnTransformer(
    transformers=[
        ('num', numeric_transformer, numeric_features),
        ('cat', categorical_transformer, categorical_features)])

# Définir les modèles de Forêt Aléatoire
success_model = Pipeline(steps=[
    ('preprocessor', preprocessor),
    ('classifier', RandomForestClassifier(random_state=42))])

reason_model = Pipeline(steps=[
    ('preprocessor', preprocessor),
    ('classifier', RandomForestClassifier(random_state=42))])

# Séparer les données en ensembles d'entraînement et de test
X_train_success, X_test_success, y_train_success, y_test_success = train_test_split(X, y_success, test_size=0.2, random_state=42)
X_train_reason, X_test_reason, y_train_reason, y_test_reason = train_test_split(X, y_reason, test_size=0.2, random_state=42)

# Entraîner les modèles
success_model.fit(X_train_success, y_train_success)
reason_model.fit(X_train_reason, y_train_reason)

# Sauvegarder les modèles entraînés
joblib.dump(success_model, 'success_model.pkl')
joblib.dump(reason_model, 'reason_model.pkl')
