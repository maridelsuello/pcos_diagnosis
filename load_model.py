import sys
import joblib
import json
import numpy as np

# Load the trained model
model = joblib.load("random_forest_pcos_model.pkl")

try:
    # Read and convert inputs
    age = float(sys.argv[1])
    bmi = float(sys.argv[2])
    menstrual = float(sys.argv[3])  # 0 or 1
    testosterone = float(sys.argv[4])
    follicle = float(sys.argv[5])

    # Input for prediction (must be a 2D array)
    input_data = np.array([[age, bmi, menstrual, testosterone, follicle]])

    # Get probability for class 1 (PCOS)
    prob = model.predict_proba(input_data)[0][1]

    # Apply your custom threshold
    threshold = 0.1
    prediction = int(prob > threshold)

    # Return result as JSON
    print(json.dumps({"prediction": prediction, "probability": round(prob, 2)}))

except Exception as e:
    print(json.dumps({"error": str(e)}))
