import 'package:intl/intl.dart' as intl;

class DateUtils {
  static String formatDateTime(String dateTimeString,
      {String format = 'yyyy-MM-dd HH:mm:ss'}) {
    final dateTime = DateTime.parse(dateTimeString);
    final formatter = intl.DateFormat(format);
    return formatter.format(dateTime);
  }
}
