<template>
  <div class="loader-container">
    <span class="loader"></span>
  </div>
</template>

<script>
export default {
  name: 'AppLoader'
}
</script>

<style scoped>
.loader-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: calc(100vh - 200px); /* Adjust this value as needed */
  margin-top: -50px; /* Adjust this value as needed */
}

.loader {
  position: relative;
  width: 100px;
  height: 130px;
  background: #fff;
  border-radius: 4px;
}

.loader:before {
  content: '';
  position: absolute;
  width: 54px;
  height: 25px;
  left: 50%;
  top: 0;
  background-image: radial-gradient(
      ellipse at center,
      #0000 24%,
      #3498db 25%,
      #3498db 64%,
      #0000 65%
    ),
    linear-gradient(to bottom, #0000 34%, #3498db 35%);
  background-size:
    12px 12px,
    100% auto;
  background-repeat: no-repeat;
  background-position: center top;
  transform: translate(-50%, -65%);
  box-shadow: 0 -3px rgba(0, 0, 0, 0.25) inset;
}

.loader:after {
  content: '';
  position: absolute;
  left: 50%;
  top: 20%;
  transform: translateX(-50%);
  width: 66%;
  height: 60%;
  background: linear-gradient(to bottom, #a5d5fa 30%, #0000 31%);
  background-size: 100% 16px;
  animation: writeDown 2s ease-out infinite;
}

@keyframes writeDown {
  0% {
    height: 0%;
    opacity: 0;
  }
  20% {
    height: 0%;
    opacity: 1;
  }
  80% {
    height: 65%;
    opacity: 1;
  }
  100% {
    height: 65%;
    opacity: 0;
  }
}
</style>
