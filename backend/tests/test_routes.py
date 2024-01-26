import unittest
from app import app, db
from app.models import User

class TestUserCRUD(unittest.TestCase):

    def setUp(self):
        app.config['TESTING'] = True
        app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:12345@localhost/bnka'
        self.app = app.test_client()
        with app.app_context():
            db.create_all()

    def tearDown(self):
        with app.app_context():
            db.session.remove()

    def test_user_crud_operations(self):
        # Crear usuario
        response = self.app.post('/create_user', json={
            'nombres': 'Davo Ramirez',
            'email': 'davo@ejemplo.com',
            'username': 'usuario_nuevo',
            'password': '12345',
            'cuenta': '1716573314',
            'saldo': 5000.0
        })
        self.assertEqual(response.status_code, 201)

        # Obtener usuario
        response = self.app.get('/get_user/usuario_nuevo')
        self.assertEqual(response.status_code, 200)
        data = response.get_json()
        self.assertEqual(data['nombres'], 'Davo Ramirez')
        self.assertEqual(data['email'], 'davo@ejemplo.com')
        self.assertEqual(data['saldo'], 5000.0)

        # Actualizar usuario
        response = self.app.put('/update_user/usuario_nuevo', json={'nombres': 'Nuevo Nombre'})
        self.assertEqual(response.status_code, 200)

        # Verificar que el usuario se ha actualizado correctamente
        response = self.app.get('/get_user/usuario_nuevo')
        self.assertEqual(response.status_code, 200)
        data = response.get_json()
        self.assertEqual(data['nombres'], 'Nuevo Nombre')

if __name__ == '__main__':
    unittest.main()
