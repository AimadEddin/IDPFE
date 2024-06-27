from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import pandas as pd

app = Flask(__name__)
CORS(app)  # Activer CORS pour toutes les routes

# Charger les modèles de machine learning
success_model = joblib.load('success_model.pkl')
reason_model = joblib.load('reason_model.pkl')

@app.route('/predict', methods=['POST'])
def predict():
    data = request.json
    df = pd.DataFrame([data])
    
    # Prédiction du succès ou échec
    success_prediction = success_model.predict(df)
    
    # Prédiction de la raison
    reason_prediction = reason_model.predict(df)
    
    response = {
        'success': success_prediction[0],
        'reason': reason_prediction[0]
    }
    
    return jsonify(response)

if __name__ == '__main__':
    app.run(debug=True)
