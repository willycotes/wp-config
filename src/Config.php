<?php
/**
 * Class Configuration with dotenv support
 */

namespace WPCotesConfig;

if ( ! class_exists( 'Config' ) ) {

	/**
	 * Custom Class Configuration Environment WordPress using DotEnv dependency
	 */
  class Config {

			/**
		 * Defined constant configuration
		 * 
		 * Lanza una exception si la constante ya está definida y si no devuelve false.
		 */
		protected static function defined( string $key ) {
			if ( defined( $key ) ) {
				$message = "Aborted trying to redefine constant '$key'. `define('$key', ...)` has already been occurred elsewhere.";
				throw new \Exception( $message );
			}
			return false;
		}

		/**
		 * Define constant configuration
		 * 
		 * Verifica los archivos de configuración y revisa si hay una constante que ya este definida, captura y lanza una excepción solo de aquellas constantes que se intentan redefinir con un valor diferente y al final solo define las constantes que no están definidas. De esta forma podemos corregir aquellas constantes que se intentan redefinir con un valor diferente.
		 * 
		 */
		public static function define( string $key, $value ) {
			/* Captura y lanza una excepción de aquellas constantes que ya existen con un valor diferente para evitar redefinirla. */
			try {
				self::defined( $key );
			} catch( Exception $e ) {
				if ( constant( $key ) !== $value ) {
					throw $e;
				}
			}
			/* Define sólo aquellas constantes que no están definidas. Sin lanzar excepciones. */
			defined( $key ) || define( $key, $value );
		}
  }
}
