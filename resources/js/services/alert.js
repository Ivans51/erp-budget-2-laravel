import Swal from 'sweetalert2'

// SweetAlert2 configuration
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

// Alert service with common methods
export const alertService = {
  // Success alert
  success(message, title = 'Success!', options = {}) {
    return Swal.fire({
      icon: 'success',
      title,
      text: message,
      timer: options.timer || 3000,
      timerProgressBar: options.timerProgressBar !== false,
      showConfirmButton: options.showConfirmButton || true,
      confirmButtonText: options.confirmButtonText || 'OK',
      confirmButtonColor: options.confirmButtonColor || '#3b82f6',
      ...options
    })
  },

  // Error alert
  error(message, title = 'Error!', options = {}) {
    return Swal.fire({
      icon: 'error',
      title,
      text: message,
      confirmButtonText: options.confirmButtonText || 'Try Again',
      confirmButtonColor: options.confirmButtonColor || '#ef4444',
      ...options
    })
  },

  // Warning alert
  warning(message, title = 'Warning!', options = {}) {
    return Swal.fire({
      icon: 'warning',
      title,
      text: message,
      confirmButtonText: options.confirmButtonText || 'OK',
      confirmButtonColor: options.confirmButtonColor || '#f59e0b',
      ...options
    })
  },

  // Info alert
  info(message, title = 'Information', options = {}) {
    return Swal.fire({
      icon: 'info',
      title,
      text: message,
      confirmButtonText: options.confirmButtonText || 'OK',
      confirmButtonColor: options.confirmButtonColor || '#3b82f6',
      ...options
    })
  },

  // Loading alert
  loading(title = 'Loading...', text = 'Please wait', options = {}) {
    return Swal.fire({
      title,
      text,
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading()
      },
      ...options
    })
  },

  // Close loading alert
  close() {
    Swal.close()
  },

  // Confirmation dialog
  confirm(message, title = 'Are you sure?', options = {}) {
    return Swal.fire({
      title,
      text: message,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: options.confirmButtonText || 'Yes',
      cancelButtonText: options.cancelButtonText || 'Cancel',
      confirmButtonColor: options.confirmButtonColor || '#10b981',
      cancelButtonColor: options.cancelButtonColor || '#6b7280',
      ...options
    })
  },

  // Custom alert
  custom(options = {}) {
    return Swal.fire(options)
  },

  // Toast notifications (small, non-intrusive)
  toastSuccess(message, title = 'Success!') {
    return Toast.fire({
      icon: 'success',
      title,
      text: message
    })
  },

  toastError(message, title = 'Error!') {
    return Toast.fire({
      icon: 'error',
      title,
      text: message
    })
  },

  toastWarning(message, title = 'Warning!') {
    return Toast.fire({
      icon: 'warning',
      title,
      text: message
    })
  },

  toastInfo(message, title = 'Info') {
    return Toast.fire({
      icon: 'info',
      title,
      text: message
    })
  },

  // Validation error handler
  validationError(errors) {
    let errorMessage = 'Validation failed'

    if (Array.isArray(errors)) {
      errorMessage = errors.join(', ')
    } else if (typeof errors === 'object') {
      const errorMessages = Object.values(errors).flat()
      errorMessage = errorMessages.join(', ')
    } else if (typeof errors === 'string') {
      errorMessage = errors
    }

    return this.error(errorMessage, 'Validation Error')
  },

  // HTTP error handler
  httpError(error, defaultMessage = 'An error occurred') {
    console.error(defaultMessage || 'An error occurred', error)
    let message = defaultMessage

    if (error.response?.data?.message) {
      message = error.response.data.message
    } else if (error.response?.data?.errors) {
      return this.validationError(error.response.data.errors)
    } else if (error.message) {
      message = error.message
    } else if (error.code === 'NETWORK_ERROR') {
      message = 'Network error. Please check your connection.'
    }

    return this.error(message)
  }
}

export default alertService
