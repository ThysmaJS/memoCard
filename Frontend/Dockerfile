FROM node:lts-alpine

# Install Vite
RUN npm install -g vite

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy project files
COPY . .

# Expose the port Vite runs on
EXPOSE 5173

# Start the application in development mode with hot-reloading
CMD ["vite", "--host", "0.0.0.0"]
