import 'package:intl/intl.dart' as intl;

class DateUtils {
  // Méthode statique pour formater une date et une heure en une chaîne de caractères selon un format spécifié
  static String formatDateTime(String dateTimeString,
      {String format = 'yyyy-MM-dd HH:mm:ss'}) {
    final dateTime = DateTime.parse(
        dateTimeString); // Convertit la chaîne de caractères en objet DateTime
    final formatter = intl.DateFormat(
        format); // Crée un formateur de date/heure avec le format spécifié
    return formatter.format(
        dateTime); // Formate la date/heure et retourne la chaîne de caractères résultante
  }
}
