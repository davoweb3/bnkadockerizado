# Usa una imagen base de Python
FROM python:3.8

# Establece el directorio de trabajo
WORKDIR /

# Copia los archivos de la aplicación al contenedor
COPY . /

# Instala las dependencias
RUN pip install --no-cache-dir -r requirements.txt

# Comando para ejecutar la aplicación
CMD ["python", "./run.py"]

# Expone el puerto en el que la aplicación estará escuchando
EXPOSE 5000


