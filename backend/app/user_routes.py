# user_routes.py
from flask import Blueprint, jsonify, request
from app.models import User
from app import db

user_blueprint = Blueprint('user', __name__)

@user_blueprint.route('/create_user', methods=['POST'])
def create_user():
 # Endpoint para crear un usuario
@app.route('/create_user', methods=['POST'])
def create_user():
    try:
        # Obtener datos del JSON en la solicitud
        data = request.get_json()

        # Validar datos de entrada
        required_fields = ['nombres', 'email', 'username', 'password', 'cuenta', 'saldo']
        for field in required_fields:
            if field not in data:
                return jsonify({'error': f'Campo obligatorio faltante: {field}'}), 400

        # Crear un nuevo usuario
        new_user = User(
            nombres=data['nombres'],
            email=data['email'],
            username=data['username'],
            password=data['password'],
            cuenta=data['cuenta'],
            saldo=data['saldo']
        )

        # Agregar el nuevo usuario a la base de datos
        db.session.add(new_user)
        db.session.commit()

        return jsonify({'message': 'Usuario creado correctamente'}), 201

    except KeyError as e:
        # Manejar errores de datos faltantes
        return jsonify({'error': f'Dato faltante: {str(e)}'}), 400

    except Exception as e:
        # Manejar posibles errores de manera adecuada
        return jsonify({'error': f'Error al crear usuario: {str(e)}'}), 500   

@user_blueprint.route('/get_user/<int:user_id>', methods=['GET'])
def get_user(user_id):