import styles from './style';
import Paper from '@mui/material/Paper';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import CircularProgress from '@mui/material/CircularProgress';
import Box from '@mui/material/Box';
import type { Column } from 'models/utils';
import Link from 'next/link';
import { Link as MLink } from '@mui/material';
import IconButton from '@mui/material/IconButton';
import EditIcon from '@mui/icons-material/Edit';

type Props<T> = {
  rows: T[];
  columns: Column[];
  height?: number;
  isLoad?: boolean;
};

function SimpleTable<T extends { id?: number }>({ rows, columns, height, isLoad }: Props<T>): JSX.Element {
  return (
    <Paper sx={{ width: '100%', overflow: 'hidden' }}>
      <TableContainer sx={{ maxHeight: height }}>
        <Table stickyHeader aria-label="sticky table">
          <TableHead>
            <TableRow>
              {columns.map((column) => (
                <TableCell
                  key={column.id}
                  align={column.align}
                  sx={{ minWidth: column.minWidth, maxWidth: column.maxWidth }}
                >
                  {column.label}
                </TableCell>
              ))}
            </TableRow>
          </TableHead>
          <TableBody>
            {!isLoad ? (
              rows.map((row) => {
                return (
                  <TableRow hover role="checkbox" tabIndex={-1} key={row.id}>
                    {columns.map((column) => {
                      if (column.id !== 'setting') {
                        // @ts-ignore 何のデータを取るか問題ないため
                        const value = row[column.id] ?? column.getValue(row);
                        return (
                          <TableCell key={column.id} align={column.align} sx={styles.td}>
                            {column.format ? column.format(value) : value}
                          </TableCell>
                        );
                      } else {
                        return (
                          <TableCell key={column.id} align={column.align}>
                            <Link href={`${column.route}/${row['id']}`} passHref>
                              <MLink>
                                <IconButton color="primary">
                                  <EditIcon />
                                </IconButton>
                              </MLink>
                            </Link>
                          </TableCell>
                        );
                      }
                    })}
                  </TableRow>
                );
              })
            ) : (
              <TableRow>
                <TableCell colSpan={columns.length} sx={{ height: 200 }}>
                  <Box textAlign="center" width="100%">
                    <CircularProgress color="primary" size={50} />
                  </Box>
                </TableCell>
              </TableRow>
            )}
          </TableBody>
        </Table>
      </TableContainer>
    </Paper>
  );
}

export default SimpleTable;
