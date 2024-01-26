# config/config.py
class Config:
 
#Remote DB
    SQLALCHEMY_DATABASE_URI = (
       'mysql+pymysql://root:12345@mysql/bnka'
    )
SQLALCHEMY_TRACK_MODIFICATIONS = False