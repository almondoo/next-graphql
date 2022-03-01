import { styled } from '@mui/system';

const Spacing = styled('div')(({ theme }) => ({
  width: '100%',
  paddingTop: '64px',
  [theme.breakpoints.down('sm')]: {
    paddingTop: '56px',
  },
}));

const exportDefault = {
  Spacing,
};

export default exportDefault;
