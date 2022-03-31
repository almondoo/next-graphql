import { gql } from '@apollo/client';

export const LOGIN_MUTATION = gql`
  mutation Logout {
    logout
  }
`;

export interface LogoutData {
  logout: boolean;
}
