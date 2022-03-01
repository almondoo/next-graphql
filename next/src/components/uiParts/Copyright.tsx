import Typography from '@mui/material/Typography';
import { Link as MLink } from '@mui/material';
import Link from 'next/link';

const Copyright = (props: any): JSX.Element => {
  return (
    <Typography variant="body2" color="text.secondary" align="center" {...props}>
      {'Copyright © '}
      <Link href="/" passHref={true}>
        <MLink color="inherit">Your Website</MLink>
      </Link>
      {new Date().getFullYear()}
      {'.'}
    </Typography>
  );
};

export default Copyright;
